<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\User_badge;
use App\Models\Badge;

class UserController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */

    //Show User Account
    public function show($id)
    {
      $user = User::find($id);
      //$this->authorize('show', $user);
      $age = Carbon::parse($user->birthday)->diff(Carbon::now())->y;
      return view('pages.user', ['user' => $user, 'age' => $age]);
    }

    //Show Homepage
    public function showHome()
    {
      $questions = Post::where('posttype', 'question')->get();
      /* print_r($questions);
      die(); */
      return view('pages.homepage', ['questions' => $questions]);
    }

    public function showBadges($id){
      $user = User::find($id);
      return view('pages.userbadges', ['user' => $user, 'badges' => $user->badges]);
    }

    //Edit Account
    public function showEditForm($id){
      $user = User::find($id);
      $this->authorize('update', $user);
      return view('pages.useredit', ['user' => $user]);
    }

    public function update(Request $request, $id){
      
      $user = User::find($id);
      $this->authorize('update', $user);

      $validate = $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users,username,'.$id,
        'email' => 'required|unique:users,email,'.$id,
        'password' => 'nullable|min:4',
      ]);

      if($request->input('name')!=$user->name) $user->name = $request->input('name');
      if($request->input('username')!=$user->username) $user->username = $request->input('username');
      if($request->input('email')!=$user->email) $user->email = $request->input('email');
      if($request->input('password')!=NULL){
        $user->password = bcrypt($request->input('password'));
      }

      $user->save();

      $id=$user->id;

      return redirect()->route('users.profile',['id'=>$id]);
    }

    //Delete Account
    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $user->delete();
      return $user;
    }

    //Show User Role
    public static function showRole()
    {
      $userID = Auth::id();
      $role = DB::table('roles')->where('userid', $userID)->value('userrole');
      return $role;
    }
}
