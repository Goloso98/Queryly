<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use Mail;
use App\Mail\RecoverPassword;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\User_badge;
use App\Models\Badge;
use App\Models\User_tag;
use App\Models\Tag;
use App\Models\Report;
use App\Models\Notification;

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
      $valid = User::where(['id' => $id, 'isdeleted' => false])->get()->isNotEmpty();
      if(!$valid){
        abort(404);
      }
      $user = User::find($id);
      return view('pages.user', ['user' => $user]);
    }

    //Show Homepage
    public function showHome()
    {
      $questions = Post::where('posttype', 'question')->get();
      return view('pages.homepage', ['questions' => $questions]);
    }

    //Show All Users
    public function showUsers()
    {
      $users = User::where('isdeleted', 'FALSE')->paginate(7);
      return view('pages.userpage', compact('users'));
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

    //Block/Unblock Profile
    public function block($id){
      $user = User::find($id);
      if($user->isblocked){
        $user->isblocked = false;
      } else {
        $user->isblocked = true;
      }
      $user->save();

      return redirect()->route('users.profile', ['id' => $id]);
    }

    //Delete Profile
    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $username = $user->name;
      $user->name = 'deleted';
      $user->username = 'deleted'.$id;
      $user->email = 'deleted'.$id;
      $user->password = 'deleted';
      $user->avatar = 'deleted';

      $user->isdeleted = true;
      $user->save();
      
      $request->session()->flash('alert-success', $username.' has been successfully deleted!');
      if(Auth::id() == $id) return redirect('logout');
      return redirect(route('users.page'));
    }

    //Search Users
    public function search(Request $request)
    {
      $request->validate([
        'search' => 'nullable',
      ]);

      $userSearch = FALSE;
      if($request->has('searchType') && $request->input('searchType') == 'user') {
        $userSearch = TRUE;
      }

      if($request->has('search') && $request->input("search") != null){
        $search_input = $request->input('search');

        $statement1 = 'tsvectors @@ plainto_tsquery(\'english\',?)';
        $users = User::whereRaw($statement1, [$search_input])->where('isdeleted', 'FALSE');
      } else {
        $users = User::all();
      }
      if($request->has('search') && $request->input("search") != null) $users = $users->get();
      return view('pages.search', ['posts' => [], 'users' => $users, 'userSearch' => $userSearch], compact('users'));
    }

    //Show User Role
    public static function showRole()
    {
      $userID = Auth::id();
      $role = DB::table('roles')->where('userid', $userID)->get();
      return $role;
    }

    //Show Tags
    public function showTags($id){
      $user = User::find($id);
      $tags = $user->tags;
      return view('pages.usertags', ['user' => $user, 'tags' => $tags]);
    }

    //Change Followed Tags
    public function showChangeTagsForm($id) {
      $user = User::find($id);
      return view('pages.tagsUpdate', ['user' => $user]);
    }

    public function changeTags(Request $request, $id){
      $tags = Tag::all();
      $user = User::find($id);
      $this->authorize('changeTags', $user);
      User_tag::where('userid', $id)->delete();
      foreach($tags as $tag){
        if($request->has($tag->tagname)){
          User_tag::insert(['userid' => $id, 'tagid' => $tag->id]);
        }
      }

      $user = User::find($id);
      $new_tags = $user->tags;
      return redirect()->route('users.tags',['user' => $user->id, 'tags' => $new_tags, 'id' => $user->id]);
    }

    public function manageReports(){
      return view('pages.manageReports', ['reports' => Report::all()]);
    }

    //Show Blocked Users
    public function showBlockedUsers() {
      $users = User::where('isblocked', 'TRUE')->get();
      return view('pages.userBlocked', ['users' => $users]);
    }

    //Recover Password
    public function recoverpasswordForm(){
      return view('auth.recoverpassword');
    }

    public function recoverpassword(Request $request){
      $validate = $request->validate([
        'email' => 'required|email'
      ]);

      $email_in = $request->input('email');
      $userid = User::where('email', $email_in)->value('id');

      if ($userid) {
        $token = Str::uuid()->toString();
        // todo
        // $token = "4d91197a-a95b-438a-9938-26566a0d2c4d";
        $request->session()->put('recover_token', $token);
        $request->session()->put('recover_mail', $email_in);

        Mail::to($email_in)->send(new RecoverPassword($token));
      }
      return view('auth.emailsent');
    }

    public function newpasswordForm($token){
      return view('auth.newpassword', ['token' => $token]);
    }

    public function newpassword(Request $request){
      $validate = $request->validate([
        'password' => 'required|string|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
        'email' => 'required|email',
        'token' => 'required|uuid'
      ]);

      $user = User::where('email', $request->input('email'))->first();

      if ($user && 
        $request->session()->exists('recover_mail') &&
        $request->session()->exists('recover_token') &&
        $request->session()->get('recover_mail') == $request->input('email') &&
        $request->session()->get('recover_token') == $request->input('token')
        ) {
          $user->password = bcrypt($request->input('password'));
          $user->save();
      }
      return redirect()->route('login');
    }

    public function getUserNotificationsCount(){
      if (Auth::check()) {
        return Auth::user()->unreadNotificationsCounter();
      }
      abort(401);
    }

    public function getUserNotifications(){
      if (!Auth::check()) {
        abort(401);
      }

      return Auth::user()->notifications()->get();
    }

    public function readNotify($id) {
      $notify = Notification::find($id);
      if(!($notify && Auth::check() && Auth::id()==$notify->userid)) abort(404);
      $notify->isread = TRUE;
      $notify->save();
      return "";
    }
}
