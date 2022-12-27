<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\User_badge;
use App\Models\Badge;
use App\Models\User_tag;
use App\Models\Tag;

class UserController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */

    //Show User Profile
    public function show($id)
    {
      $user = User::find($id);
      return view('pages.user', ['user' => $user]);
    }

    //Show Homepage
    public function showHome()
    {
      $questions = Post::where('posttype', 'question')->get();
      /* print_r($questions);
      die(); */
      return view('pages.homepage', ['questions' => $questions]);
    }

    //Show All Users
    public function showUsers()
    {
      $users = User::all();
      return view('pages.userpage', ['users' => $users]);
    }

    public function showBadges($id){
      $user = User::find($id);
      return view('pages.userbadges', ['user' => $user, 'badges' => $user->badges]);
    }

    //Edit Profile
    public function showEditForm($id){
      $user = User::find($id);
      $this->authorize('update', $user);
      return view('pages.useredit', ['user' => $user]);
    }

    public function update(Request $request, $id){
      //Image::make('public/blank-profile-picture-973460_960_720.png')->resize(300,300)->encode('jpg')->encode('data-url')->encoded
      
      $user = User::find($id);
      $this->authorize('update', $user);
      
      $validate = $request->validate([
        'name' => 'required',
        'username' => 'required|min:4|max:20|unique:users,username,'.$id,
        'email' => 'required|unique:users,email,'.$id,
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'password' => 'nullable|string|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|confirmed'
      ]);

      if($request->input('name')!=$user->name) $user->name = $request->input('name');
      if($request->input('username')!=$user->username) $user->username = $request->input('username');
      if($request->input('email')!=$user->email) $user->email = $request->input('email');
      if($request->input('password')!=NULL){
        $user->password = bcrypt($request->input('password'));
      }
      $image = $request->file('avatar');
      if($request->hasFile('avatar') && $image->isValid()) {
        $img = Image::make($image->getRealPath())->resize(300,300)->encode('jpg')->encode('data-url')->encoded;
        $user->avatar = $img;
      }

      $user->save();

      $id=$user->id;

      $request->session()->flash('alert-success', 'User has been successfully edited!');

      return redirect()->route('users.profile',['id'=>$id]);
    }

    //Delete Profile
    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $user->delete();
      return $user;
    }

    //Search Users
    public function search(Request $request)
    {
      $request->validate([
        'search' => 'required',
      ]);

      $userSearch = FALSE;
      if($request->has('searchType') && $request->input('searchType') == 'user') {
        $userSearch = TRUE;
      }

      if($request->has('search')){
        $search_input = $request->input('search');

        $statement1 = 'tsvectors @@ plainto_tsquery(\'english\',?)';
        $users = User::whereRaw($statement1, [$search_input]);
      } else {
        //here because code gets angry otherwise
        $users = User::all();
      }
      
      return view('pages.search', ['posts' => [], 'users' => $users->get(), 'userSearch' => $userSearch], compact('users'));
    }


    //Show User Role
    public static function showRole()
    {
      $userID = Auth::id();
      $role = DB::table('roles')->where('userid', $userID)->get();
      return $role;
    }

    //Show Tags
    public function showTags(){
      $user = User::find(Auth::id());
      $tags = $user->tags;
      return view('pages.usertags', ['user' => $user, 'tags' => $tags]);
    }

    //Change Followed Tags
    public function changeTags(Request $request, $id){
      $tags = Tag::all();
      User_tag::where('userid', $id)->delete();
      foreach($tags as $tag){
        if($request->has($tag->tagname)){
          User_tag::insert(['userid' => $id, 'tagid' => $tag->id]);
        }
      }

      $user = User::find($id);
      $new_tags = $user->tags;
      return view('pages.usertags', ['user' => $user, 'tags' => $new_tags]);
    }
}
