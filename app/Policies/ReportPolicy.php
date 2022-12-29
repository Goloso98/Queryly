<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Report;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Report $report){
        $role = $user->roles()->get()->pluck('userrole')->contains('Moderator');
        return ($role);
    }
}