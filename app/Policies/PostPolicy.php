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
      return true;
    }

    public function update(User $user){
      return true;
    }

    public function delete(Post $post){
      return true;
    }
}