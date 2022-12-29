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
      return (Auth::check());
    }

    public function update(User $user, User $user_to_evaluate){
      $role = $user->roles()->get()->pluck('userrole')->contains('Administrator');
      return ($user->id == $user_to_evaluate->id || $role);
    }

    public function delete(User $user, User $user_to_evaluate){
      $role = $user->roles()->get()->pluck('userrole')->contains('Administrator');
      return ($user->id == $user_to_evaluate->id || $role);
    }

    public function changeTags(User $user, User $user_to_evaluate){
      return ($user->id == $user_to_evaluate->id);
    }
}
