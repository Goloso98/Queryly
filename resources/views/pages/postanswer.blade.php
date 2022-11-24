@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addAnswer') }}">
    {{ csrf_field() }}
    <h3>Post your answer</h3>
    <br>
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