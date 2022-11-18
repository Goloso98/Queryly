<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Shows the user for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }

    public function showHome()
    {
      return view('layouts.app');
    }

    public function showEditForm($id){
      $user = User::find($id);
      $this->authorize('update', $user);
      return view('pages.profile', ['user' => $user]);
    }

    public function update(Request $request, $id){
      
      $user = User::find($id);
      $this->authorize('update', $user);

      /* $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|unique:users',
        'password' => 'required|min:4',
      ]); */

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

    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $user->delete();
      return $user;
    }
}
