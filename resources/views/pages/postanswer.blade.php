@extends('layouts.app')

@section('content')
<br>
<h2 class="centering">Post Your Answer</h2>
<hr>
<br>

<div class="card">
  <div class="card-body">
    @php
      $username = DB::table('users')->find($post->userid)->username;
    @endphp
    <h4 class="card-title">Answer to: {{ $post->title }}</h4>
    <p class="card-text">{{ $post->posttext }}</p>
    {{ $post->postdate }}
    <a class="btn" aria-current="page" href="{{route('users.profile', $post->userid)}}">&#64;{{$username}}</a>   
  </div>
</div>
<br>

<form method="POST" action="{{ route('posts.addAnswer') }}">
    {{ csrf_field() }}
    <input type="hidden" name="parentPost" value="{{ $post->id }}">
    <div class="mb-3">
      <h5>Text</h5>
      @if ($errors->has('postText'))
        <span class="error">
          {{ $errors->first('postText') }}
        </span>
      @endif
      <textarea name="postText" id="postText" class="form-control" rows="8" maxlength="1000"></textarea>
      <div id="count-postText">
        <span id="current-postText">0</span>
        <span id="maximum-postText">/ 1000</span>
      </div>
    </div>
    <br>
    
    <div class="buttons">
      <button type="submit" class="btn outlined">
        Answer
      </button>
      <p><a href="{{ route('posts.postPage', $post->id) }}" class="btn">Cancel</a></p>
    </div>
    <br>
</form>
@endsection