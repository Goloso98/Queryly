@extends('layouts.app')

@section('content')
<br>
<h2 class="text-center">Post Your Question</h2>
<br>
<form method="POST" action="{{ route('addQuestion') }}">
    {{ csrf_field() }}
    <div class="mb-3">
      <h4>Title</h4>
      @if ($errors->has('title'))
        <span class="error">
          {{ $errors->first('title') }}
        </span>
      @endif
      <textarea name="title" id="postTitle" class="form-control" rows="2" maxlength="200" required></textarea>
      <div id="count-postTitle">
        <span id="current-postTitle">0</span>
        <span id="maximum-postTitle">/ 200</span>
      </div>
    </div>
    <div class="mb-3">
      <h5>Text</h5>
      @if ($errors->has('postText'))
        <span class="error">
          {{ $errors->first('postText') }}
        </span>
      @endif
      <textarea name="postText" id="postText" class="form-control" rows="8" maxlength="1000" required></textarea>
      <div id="count-postText">
        <span id="current-postText">0</span>
        <span id="maximum-postText">/ 1000</span>
      </div>
    </div>

    <div class="text-center">
      <button type="submit">
        Ask
      </button>
      <p><a href="#" onclick="history.back()">Cancel</a></p>
    </div>
    <br>
</form>
@endsection