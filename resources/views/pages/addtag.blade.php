@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.addForm') }}">
        {{ csrf_field() }}
        @if ($errors->has('tagname'))
            <span class="error">
            {{ $errors->first('tagname') }}
            </span>
        @endif
        <textarea name="tagname" id="tagname" class="form-control" rows="1"></textarea>
        <br>
        <div class="text-center">
            <button type="submit">Save Changes</button>
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection