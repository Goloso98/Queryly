@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addQuestion') }}">
    {{ csrf_field() }}

    <label for="title">Title</label>
    <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus>

    <label for="postText">Write your Question</label>
    <input id="postText" type="text" name="postText" value="{{ old('postText') }}" required autofocus>

    <button type="submit">
      Ask
    </button>
</form>
@endsection