<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Role;

class CommentController extends Controller
{
    public function show($id){
        //$post = Post::find($id);

    }
}