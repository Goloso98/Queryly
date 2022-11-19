@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addAnswer') }}">
    {{ csrf_field() }}

    <label for="postText">Write your Answer</label>
    <input id="postText" type="text" name="postText" value="{{ old('postText') }}" required autofocus>
    <input id="parentPost" type="hidden" name="parentPost" value="{{ $postParent }}">

    <button type="submit">
      Answer
    </button>
</form>
@endsection