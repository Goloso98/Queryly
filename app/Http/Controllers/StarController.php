<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Star;
use App\Models\Badge;
use App\Models\User_badge;

class StarController extends Controller
{
    public function create($userid, $postid){
        if (Auth::check()){
            Star::insert(['postid' => $postid, 'userid' => $userid]);

            $starcount = 0;
            $postStared = Post::find($postid);
            $originalUser = User::find($postStared->userid);
            $originalUserid = $originalUser->id;
    
            $posts = Post::where(['userid' => $originalUserid])->get(); 
            foreach($posts as $post){
              $starspost = Star::where(['postid' => $post->id])->count();
              $starcount = $starcount + $starspost;
            }
            
            if($starcount == 1){
              $badgeid = Badge::where('badgename', 'Someone liked a post you made!')->get()->value('id');
              $badge = User_badge::where(['userid' => $originalUserid, 'badgeid' => $badgeid])->get();
              if($badge->count() == 0) User_badge::insert(['userid' => $originalUserid, 'badgeid' => $badgeid]);
            } else if($starcount == 5){
              $badgeid = Badge::where('badgename', '5 people liked a post you made!')->get()->value('id');
              $badge = User_badge::where(['userid' => $originalUserid, 'badgeid' => $badgeid])->get();
              if($badge->count() == 0) User_badge::insert(['userid' => $originalUserid, 'badgeid' => $badgeid]);
            } else
            if($starcount == 10){
              $badgeid = Badge::where('badgename', '10 people liked a post you made!')->get()->value('id');
              $badge = User_badge::where(['userid' => $originalUserid, 'badgeid' => $badgeid])->get();
              if($badge->count() == 0) User_badge::insert(['userid' => $originalUserid, 'badgeid' => $badgeid]);
            } else if($starcount == 15){
              $badgeid = Badge::where('badgename', '15 people liked a post you made!')->get()->value('id');
              $badge = User_badge::where(['userid' => $originalUserid, 'badgeid' => $badgeid])->get();
              if($badge->count() == 0) User_badge::insert(['userid' => $originalUserid, 'badgeid' => $badgeid]);
            } else if($starcount == 20){
              $badgeid = Badge::where('badgename', '20 people liked a post you made!')->get()->value('id');
              $badge = User_badge::where(['userid' => $originalUserid, 'badgeid' => $badgeid])->get();
              if($badge->count() == 0) User_badge::insert(['userid' => $originalUserid, 'badgeid' => $badgeid]);
            }
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