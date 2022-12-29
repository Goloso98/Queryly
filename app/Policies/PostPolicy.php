<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    public function show(User $user){
      return true;
    }

    public function update(User $user, Post $post){
      $role = Auth::user()->roles()->get()->pluck('userrole')->contains('Moderator');
      return (Auth::user()->id == $post->userid || $role);
    }

    public function updateTags(User $user, Post $post){
      return (Auth::user()->roles()->get()->pluck('userrole')->contains('Moderator'));
    }

    public function delete(User $user, Post $post){
      $role = Auth::user()->roles()->get()->pluck('userrole')->contains('Moderator');
      return (Auth::user()->id == $post->userid || $role);
    }

    public function markcorrect(User $user, Post $post){
      $parent = Post::find($post->parentpost);
      return (Auth::id() == $parent->userid);
    }
}