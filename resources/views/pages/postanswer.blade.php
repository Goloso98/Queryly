@extends('layouts.app')

@section('content')
<p></p>
<h2 class="text-center">Post Your Answer</h2>
<p></p>

<div class="card">
  <div class="card-body">
    @php
      $username = DB::table('users')->find($post->userid)->username;
    @endphp
    <h4 class="card-title">Answer to: {{ $post->title }}</h4>
    <p class="card-text">{{ $post->postText }}</p>
    {{ $post->postdate }}
    <a class="btn" aria-current="page" href="{{route('users.profile', $post->userid)}}">&#64;{{$username}}</a>   
  </div>
</div>

<form method="POST" action="{{ route('posts.addAnswer') }}">
    {{ csrf_field() }}
    <input type="hidden" name="parentPost" value="{{ $post->id }}">
    <div class="mb-3">
      <h5>Text</h5>
      <textarea name="postText" id="postText" class="form-control" rows="8"></textarea>
    </div>

    <div class="text-center">
      <button type="submit">
        Answer
      </button>
      <p><a href="#" onclick="history.back()">Cancel</a></p>
    </div>
    <br>
</form>
@endsection