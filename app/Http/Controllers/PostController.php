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

    public function showEditForm($id){
      $post = Post::find($id);
      //$this->authorize('update', $question);
      return view('pages.editpost', ['post' => $post]);
    }

    public function update(Request $request, $id){
      
      $post = Post::find($id);
      //$this->authorize('update', $post);

      /* $request->validate([
        'title' => 'required',
        'posttext' => 'required',
      ]); */

      if($post->posttype == 'question' && $request->input('title')!=$post->title) $post->title = $request->input('title');
      if($request->input('posttext')!=$post->posttext) $post->posttext = $request->input('posttext');

      $post->save();

      //temporary before merging with post_question branch
      $id=$post->userid;

      return redirect()->route('users.profile',['id'=>$id]);
    }

}

