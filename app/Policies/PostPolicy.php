<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function show(User $user){
      return true;
    }

    public function update(User $user, Post $post){
      return (Auth::user()->id == $post->userid);
    }

    public function delete(User $user, Post $post){
      return (Auth::user()->id == $post->userid);
    }
}