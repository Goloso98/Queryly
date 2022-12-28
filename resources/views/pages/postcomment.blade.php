@extends('layouts.app')

@section('title', $post->title)

@section('content')
<br>
<h2 class="text-center">Post Your Comment</h2>
<br>

<form method="POST" action="{{ route('addComment', $post->id) }}">
    {{ csrf_field() }}
    
    <div class="card">
        <div class="card-body">
            @if($post->posttype == 'question')
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="card-text">{{ $post->posttext }}</p>
                {{ $post->postdate }}
            @else
                @if($showTitle)
                    <h3 class="card-title">Answer to: {{ App\Models\Post::find($post->parentpost)->title }}</h3>
                @endif
                <p class="card-text">{{ $post->posttext }}</p>
                {{ $post->postdate }}           
            @endif
            @if($showUser)
                @php
                    $username = DB::table('users')->find($post->userid)->username;
                @endphp
                <a class="btn" aria-current="page" href="{{route('users.profile', $post->userid)}}">&#64;{{$username}}</a>
            @endif
        </div>
    </div>
    
    <br>
    <div class="mb-3">
      <h5>Comment:</h5>
      @if ($errors->has('commenttext'))
        <span class="error">
          {{ $errors->first('commenttext') }}
        </span>
      @endif
      <textarea name="commenttext" id="commentText" class="form-control" rows="8" maxlength="250"></textarea>
      <div id="count-commentText">
        <span id="current-commentText">0</span>
        <span id="maximum-commentText">/ 250</span>
      </div>
    </div>
    <br>
    <div class="buttons">
      <button type="submit" class="btn outlined">Comment</button>
      @if($post->posttype == 'question')
        <p><a href="{{ route('posts.postPage', $post->id) }}" class="btn">Cancel</a></p>
      @else
        <p><a href="{{ route('posts.postPage', $post->parentpost) }}" class="btn">Cancel</a></p>
      @endif
    </div>
    <br>
</form>
@endsection