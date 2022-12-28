<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User_tag;

class TagController extends Controller
{   
    public function show(){
        return view('pages.tagspage', ['tags' => Tag::all()]);
    }

    public function createForm(){
        return view('pages.addtag');
    }

    public function create(Request $request){
        $this->authorize('create', Tag::class);

        $validate = $request->validate([
            'tagname' => 'required|unique:tags'
        ]);

        $tagname = $request->input('tagname');
        Tag::insert(['tagname' => $tagname]);
        return redirect()->route('tags.page');
    }

    public function deleteForm(){
        return view('pages.deletetag');
    }

    public function delete(Request $request){
        $this->authorize('delete', Tag::class);

        $tags = Tag::all();
        foreach($tags as $tag){
            if($request->has($tag->id)){
                Tag::where('id', $tag->id)->delete();
            }
        }
        return redirect()->route('tags.page');
    }
}