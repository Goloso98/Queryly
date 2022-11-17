<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      $user = Auth::user();
      if($post->posttype == 'question') {
        return view('pages.questionpage', ['user' => $user, 'question' => $post]);
      } else {
        //return view('pages.answer', ['post' => $post]); TO DO
      }
    }

   /**
     * Shows all cards.
     *
     * @return Response
     */
    public function showUserQuestions($userID)
    {
      if (!Auth::check()) return redirect('/login');
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
      if (!Auth::check()) return redirect('/login');
      $user = User::find($userID);
      $allposts = $user->posts()->orderBy('id')->get();
      $answers=[];
      for($i=0; $i<count($allposts); $i++){
        if($allposts[$i]->posttype == 'answer') array_push($answers, $allposts[$i]);
      }
      return view('pages.useranswers', ['user' => $user, 'answers' => $answers]);
    }

    public function delete(Request $request, $id)
    {
      $post = Post::find($id);
      //$this->authorize('delete', $post);
      $post->delete();
      return $post;
    }

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


}

