@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.deleteForm') }}">
        {{ csrf_field() }}
        <h3>Select the tags to delete:</h3>
        @foreach(App\Models\Tag::all() as $tag)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" >
                <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
            </div>
        @endforeach
        <br>
        <div class="text-center">
            <button type="submit">Delete Selected Tags</button>
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection