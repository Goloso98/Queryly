<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    public function show(User $user){
      return true;
    }

    public function update(User $user, Comment $comment){
      $role = Auth::user()->roles()->get()->pluck('userrole')->contains('Moderator');
      return (Auth::user()->id == $comment->userid || $role);
    }

    public function delete(User $user, Comment $comment){
      $role = Auth::user()->roles()->get()->pluck('userrole')->contains('Moderator');
      return (Auth::user()->id == $comment->userid || $role);
    }
}