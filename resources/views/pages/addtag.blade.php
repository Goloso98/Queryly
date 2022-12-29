@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.addForm') }}">
        {{ csrf_field() }}
        <h2 class="centering">Insert New Tag</h2>
        <hr>
        <br>
        @if ($errors->has('tagname'))
            <span class="error">
            {{ $errors->first('tagname') }}
            </span>
        @endif
        <h5>Tag Name</h5>
        <textarea name="tagname" id="tagname" class="form-control" rows="1"></textarea>
        <br>
        <div class="buttons">
            <button type="submit" class="btn outlined">Add</button>
            <p><a href="{{ route('tags.page') }}" class="btn">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection