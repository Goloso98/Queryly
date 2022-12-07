<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;

class PostController extends Controller
{

    //homepage
    public function show($id)
    {
      $post = Post::find($id);
      if($post->posttype == 'question')
        return view('pages.questionpage', ['question' => $post]);
    }

    //Own user questions and answers

    public function showUserQuestions($userID)
    {
      $user = User::find($userID);
      $questions = Post::where('posttype', 'question');
      $questions = $questions->where('userid', $userID)->get();
      return view('pages.userquestions', ['user' => $user, 'questions' => $questions]);
    }

    public function showUserAnswers($userID)
    {
      $user = User::find($userID);
      $answers = Post::where('posttype', 'answer');
      $answers = $answers->where('userid', $userID)->get();
      return view('pages.useranswers', ['user' => $user, 'answers' => $answers]);
    }

    //Comments to a post
    public function showComments($id){
      $post = Post::find($id);
      $comments = Comment::where('postid', $id)->get();
      return view('pages.postcomments', ['post' => $post, 'comments' => $comments]);
    }

    //Delete post
    public function delete(Request $request, $id)
    {
      $post = Post::find($id);
      $this->authorize('delete', $post);
      $post->delete();
      return $post;
    }

    //Add question
    public function showAddQuestionForm()
    {
      if (!Auth::check()) return redirect('/login');
      return view('pages.postquestion');
    }

    protected function postQuestion(Request $request)
    {
      $userID = Auth::id();
      $title = $request->input('title');
      $postText = $request->input('postText');
      $data = array('userid' => $userID, 'posttype' => 'question', 'title' => $title, 'posttext' => $postText );
      $postID = DB::table('posts')->insertGetId($data);

      $question = Post::find($postID);
      $user = Auth::user();

      return view('pages.questionpage', ['user' => $user, 'question' => $question]);
    }

    //Add answer
    public function showAddAnswerForm(Request $request)
    {
      if (!Auth::check()) return redirect('/login');
      $postParent = $request->input('question');
      return view('pages.postanswer', ['postParent' => $postParent]);
    }

    protected function postAnswer(Request $request)
    {
      $userID = Auth::id();
      $postText = $request->input('postText');
      $parentPost = $request->input('parentPost');
      $data = array('userid' => $userID, 'posttype' => 'answer', 'posttext' => $postText, 'parentpost' => $parentPost, 'iscorrect' => 'false');
      $postID = DB::table('posts')->insertGetId($data);

      $question = Post::find($parentPost);
      $answer = Post::find($postID);
      $user = Auth::user();

      return view('pages.questionpage', ['user' => $user, 'question' => $question]);
    }

    //Edit post
    public function showEditForm($id){
      if (!Auth::check()) return redirect('/login');
      $post = Post::find($id);
      return view('pages.editpost', ['post' => $post]);
    }

    public function update(Request $request, $id){
      $post = Post::find($id);
      $this->authorize('update', $post);

      $validate = $request->validate([
        'title' => 'nullable|max:255',
        'posttext' => 'required',
      ]);

      if($post->posttype == 'question' && $request->input('title')!=$post->title) $post->title = $request->input('title');
      if($request->input('posttext')!=$post->posttext) $post->posttext = $request->input('posttext');

      $post->save();

      $id=$post->id;

      if($post->posttype == 'question')
        return redirect()->route('posts.postPage',['id'=>$id]);
      return redirect()->route('posts.postPage', ['id'=>$post->parentpost]);
    }

    public function search(Request $request)
    {
      $request->validate([
            'search' => 'nullable',
            'tags' => 'nullable',
            'orderby' => 'required',
            'searchfor' => 'required',
      ]);

      $order = $request->input('orderby');
      $searchfor = $request->input('searchfor');

      if($request->has('search')){
        $title = $request->input('search');
        $statement1 = 'tsvectors @@ plainto_tsquery(\'english\',\'?\')';
        $posts = Post::whereRaw($statement1, [$title]);

        $name = $request->input('search');
        $statement2 = 'tsvectors @@ plainto_tsquery(\'english\',\'?\')';
        $users = User::whereRaw($statement2, [$name]);
      } else {
        //here because code gets angry otherwise
        $posts = Post::all();
        $users = User::all();
      }

/*      if($request->has('search')){
        $title = $request->input('search');
        $posts = Post::where('title','ILIKE',"$title");
      }
*/

      if($request->has('tags')){
        $tag = $request->input('tags');
        //$tags = Tag::where('tagname', 'ILIKE', "$tag");
        //$tagsid -> get ids
        //$relationships = Question_Tag::where('tagid','ILIKE',"$tagids");
        /* for($i = 0; $i < $ralationships.length(); $i++){
          $postid = $relationships -> get post ids
          $posts->where('id', 'LIKE', $postid);
        } */
      }

      if($order == 'Newest'){
        $posts = $posts->orderBy('postdate', 'DESC');
      } else if ($order == 'Oldest'){
        $posts = $posts->orderBy('postdate', 'ASC');
      }

      $posts = $posts->get();
      $users = $users->get();

      return view('pages.search', ['searchfor' => $searchfor, 'questions' => $posts, 'users' => $users], compact('posts'));
    }

    //Show Post's Answers
    public static function showAnswers($postParent) {
      $allposts = Post::all();
      $answers=[];
      for($i=0; $i<count($allposts); $i++){
        if($allposts[$i]->posttype == 'answer' && $allposts[$i]->parentpost == $postParent) array_push($answers, $allposts[$i]);
      }
      return $answers;
    }

    //Show Top Questions
    public function showTopQuestions(){
      $limit = 5;
      $postData = DB::select(
        //DB::raw("select p.*, count(s.userId) nstars from posts p, stars s where p.id = s.postId group by (p.id) order by (nstars) desc limit 5"));
        DB::raw("select p.*, count(s.userId) nstars
          from posts p, stars s
          where p.id = s.postId and p.posttype = 'question'
          group by (p.id)
          order by nstars desc
          limit ".$limit));
      $postModels = Post::hydrate($postData);
      //dd($postData);
      $countleft = $limit - count($postModels);
      if ($countleft) {
        $arrSelected = $postModels->pluck('id')->all();

        $postLeft = Post::where('posttype', '=', 'question')->whereNotIn('id', $arrSelected)->orderBy('id')->limit($countleft)->get();
        $postModels->push($postLeft->all());
      }
      return view('pages.topquestions', ['questionStars'=>$postModels->flatten()]);
    }

    public function correctness($postid){
      $userid = Auth::id();
      $post = Post::find($postid);
      error_log($post->iscorrect);
      $this->authorize('markcorrect', $post);
      if($post->iscorrect){
        $post->iscorrect = false;
      } else {
        $post->iscorrect = true;
      }

      $post->save();
      return;
    }
}
