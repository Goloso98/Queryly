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
    public function create($userid, $postid){
        if (Auth::check()){
            DB::table('stars')->insert(['postid' => $postid, 'userid' => $userid]);
        }
        return;
    }

    public function delete($userid, $postid){
        $star = Star::where('userid', $userid)->where('postid', $postid)->get();
        $stardelete = Star::find($star[0]->id);
        $this->authorize('unlikeaction', $stardelete);
        $stardelete->delete();
        return $stardelete;
    }

}