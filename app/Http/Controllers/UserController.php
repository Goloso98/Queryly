<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
      $this->authorize('show', $user);
      return view('pages.profile', ['user' => $user]);
    }

    public function update($id){
      $user = User::find($id);
      $this->validate(request(), [
        'username' => 'unique:users',
        'email' => 'email|unique:users',
      ]);

      $user->name = request('name');
      $user->username = request('username');
      $user->email = request('email');
      $user->password = bcrypt(request('password'));

      $user->save();

      return back();
    }
}
