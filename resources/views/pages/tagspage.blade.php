@inject('user', 'App\Http\Controllers\UserController')

@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <h2 class="centering">Existing Tags ({{ $tags->count() }}):</h2>
    <br>
    @php
      $role = app\Http\Controllers\UserController::showRole();
      $roleAdmin = $role->contains(function($item){
          return $item->userrole === 'Administrator';
        });
      $roleMod = $role->contains(function($item){
          return $item->userrole === 'Moderator';
        });
    @endphp
    @if($roleAdmin)
        <div class="centering">
            <a class="btn" aria-current="page" href="{{ route('tags.addForm') }}">Add Tags</a>
            <a class="btn" aria-current="page" href="{{ route('tags.deleteForm') }}">Delete Tags</a>
        </div>
        <br>
    @endif

    <table class="table centering centering">
        <thead>
            <tr>
            <th scope="col">Tag Name</th>
            <th scope="col">Followers</th>
            <th scope="col">Posts</th>
            <th scope="col">Follow</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->tagname }}</td>
                    @php
                        $countFollow = DB::table('user_tags')->where('tagid', $tag->id)->count();
                    @endphp
                    <td>{{ $countFollow }}</td>
                    @php
                        $countPosts = DB::table('question_tags')->where('tagid', $tag->id)->count();
                    @endphp
                    <td>{{ $countPosts }}</td>
                    @php
                        $follow = DB::table('user_tags')->where('userid', Auth::id())->where('tagid', $tag->id)->get()
                    @endphp
                    @if($follow->count())
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection