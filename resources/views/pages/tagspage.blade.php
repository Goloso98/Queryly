@inject('user', 'App\Http\Controllers\UserController')

@extends('layouts.app')

@section('content')
    <br><br>
    <h2 class="centering">Existing Tags ({{ $tags->count() }}):</h2>
    <hr>
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
            @if(Auth::check())
            <th scope="col">Follow</th>
            @endif
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
                    @if(Auth::check())
                    @php
                        $hasfollows = DB::table('user_tags')->where('userid', Auth::id())->where('tagid', $tag->id)->get()->isNotEmpty();
                    @endphp
                    @if($hasfollows)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection