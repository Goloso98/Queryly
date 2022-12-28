@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.addForm') }}">
        {{ csrf_field() }}
        <h2 class="text-center">Insert New Tag</h2>
        <br>
        @if ($errors->has('tagname'))
            <span class="error">
            {{ $errors->first('tagname') }}
            </span>
        @endif
        <h5>Tag Name</h5>
        <textarea name="tagname" id="tagname" class="form-control" rows="1"></textarea>
        <br>
        <div id="buttons">
            <button type="submit" class="btn" id="outlined">Add</button>
            <p><a href="{{ route('tags.page') }}" class="btn">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection