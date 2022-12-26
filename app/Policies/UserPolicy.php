<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
      return (Auth::user()->id == $user->id);
    }

    public function update(User $user){
      return (Auth::user()->id == $user->id);
    }

    public function delete(User $user){
      return (Auth::user()->id == $user->id);
    }
}
