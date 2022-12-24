<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Star;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class StarPolicy
{
    use HandlesAuthorization;

    public function unlikeaction(User $user, Star $star){
        if(Auth::check()) return true;
        return false;
    }
}