<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;
use App\Models\User;

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
      $allposts = $user->posts()->orderBy('id')->get();
      $questions=[];
      for($i=0; $i<count($allposts); $i++){
        if($allposts[$i]->posttype == 'question') array_push($questions, $allposts[$i]);
      }
      return view('pages.userquestions', ['user' => $user, 'questions' => $questions]);
    }

    public function showUserAnswers($userID)
    {
      $user = User::find($userID);
      $allposts = $user->posts()->orderBy('id')->get();
      $answers=[];
      for($i=0; $i<count($allposts); $i++){
        if($allposts[$i]->posttype == 'answer') array_push($answers, $allposts[$i]);
      }
      return view('pages.useranswers', ['user' => $user, 'answers' => $answers]);
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
        $statement1 = 'tsvectors @@ plainto_tsquery(\'english\',\''.$title.'\')';
        $posts = Post::whereRaw($statement1);

        $name = $request->input('search');
        $statement2 = 'tsvectors @@ plainto_tsquery(\'english\',\''.$name.'\')';
        $users = User::whereRaw($statement2);
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
      // $allposts = DB::table('posts')->get();
      // $questions=[];
      // for($i=0; $i<count($allposts); $i++){
      //   if($allposts[$i]->posttype == 'question') array_push($questions, $allposts[$i]);
      // }

      // $stars = [];
      // for($i=0; $i<count($questions); $i++){
      //   $stars[$i] = DB::table('stars')->where('postid', $questions[$i]->id)->count();
      // }

      // $questionStars = [];
      // for($i=0; $i<count($questions); $i++){
      //   $temp = array($stars[$i], $questions[$i]->id);
      //   array_push($questionStars, $temp);
      // }

      // arsort($questionStars);

      // $orderQuestions = [];
      // for($i=0; $i<count($questionStars); $i++){
      //   $orderQuestions[$i] = $questionStars[$i]->last();
      // }
      $orderQuestionsRaw = DB::select(DB::raw("select s.postid, count(s.userid) nstar from stars s group by s.postid
      order by nstar desc;")); //DB::raw("select s.postid, count(s.userid) nstar from stars s group by s.postid order by nstar desc;")->get();

      $getQuestions = array();
      foreach ($orderQuestionsRaw as $postid) {
        array_push($getQuestions, $postid->postid);
      }
      $orderQuestions = Post::findMany($getQuestions);
      return view('pages.topquestions', ['questionStars'=>$orderQuestions]);
    }

}