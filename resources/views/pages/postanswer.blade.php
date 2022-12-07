@extends('layouts.app')

@section('content')
<p></p>
<h2 class="text-center">Post Your Answer</h2>
<p></p>
<form method="POST" action="{{ route('posts.addAnswer') }}">
    {{ csrf_field() }}
    <input type="hidden" name="parentPost" value="{{ $postParent }}">
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