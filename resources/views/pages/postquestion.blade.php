@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addQuestion') }}">
    {{ csrf_field() }}
    <h3>Post your question</h3>
    <br>
    <div class="mb-3">
      <h4>Title</h4>
      <textarea name="title" id="title" class="form-control" rows="2" maxlength="200"></textarea>
      <div id="the-count">
        <span id="current">0</span>
        <span id="maximum">/ 200</span>
      </div>
    </div>
    <div class="mb-3">
      <h5>Text</h5>
      <textarea name="postText" id="postText" class="form-control" rows="8"></textarea>
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