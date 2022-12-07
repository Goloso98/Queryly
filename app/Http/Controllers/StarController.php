<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Role;
use App\Models\Star;

class StarController extends Controller
{
    public function create($postid){
        $userid = Auth::id();
        DB::table('stars')->insert(['postid' => $postid, 'userid' => $userid]);;
        return;
    }

}