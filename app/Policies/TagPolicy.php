<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User_tag;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TagPolicy
{
    use HandlesAuthorization;

    public function show(User $user){
      return true;
    }

    public function create(User $user){
      return (Auth::check() && Auth::user()->roles()->get()->pluck('userrole')->contains('Administrator'));
    }

    public function delete(User $user){
      return (Auth::check() && Auth::user()->roles()->get()->pluck('userrole')->contains('Administrator'));
    }

}