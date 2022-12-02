<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Role;

class CommentController extends Controller
{
    public function show($id){

    }

    public function showCreateForm($id){
        if (!Auth::check()) return redirect('/login');
        $post = Post::find($id);
        return view('pages.postcomment', ['post' => $post, 'showUser' => TRUE, 'showTitle' => TRUE]);
    }

    public function postComment(Request $request, $id){
        
        $user = Auth::user();
        $post = Post::find($id);

        $validate = $request->validate([
            'commenttext' => 'required|max:500',
        ]);

        $commentText = $request->input('commenttext');

        $data = array('userid' => $user->id, 'postid' => $id, 'commenttext' => $commentText);

        $postID = DB::table('comments')->insertGetId($data);
        
        if($post->posttype == 'question') return view('pages.questionpage', ['user' => $user, 'question' => $post]);
        if($post->posttype == 'answer') return view('pages.questionpage', ['user' => $user, 'question' => Post::find($post->parentpost)]);
    }

    //edit comments
    public function showEditForm($id){
        if (!Auth::check()) return redirect('/login');
        $comment = Comment::find($id);
        return view('pages.editcomment', ['comment' => $comment]);
    }

    public function update(Request $request, $id){
        $comment = Comment::find($id);

        $this->authorize('update', $comment);
  
        $validate = $request->validate([
          'commenttext' => 'required|max:500',
        ]);
        if($request->input('commenttext')!=$comment->commenttext) $comment->commenttext = $request->input('commenttext');
  
        $comment->save();

        return redirect()->route('posts.comments', ['id'=>$comment->postid]);
        
    }

    //Delete comment
    public function delete(Request $request, $id)
    {
        $comment = Comment::find($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return $comment;
    }
}