@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.deleteForm') }}">
        {{ csrf_field() }}
        <h3>Select the tags to delete:</h3>
        @foreach(App\Models\Tag::all() as $tag)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->id }}" name="{{ $tag->id }}" >
                <label class="form-check-label" for="{{ $tag->id }}">{{ $tag->tagname }}</label>
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