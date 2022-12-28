@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.deleteForm') }}">
        {{ csrf_field() }}
        <h2 class="text-center">Delete Tags</h2>
        <br>
        <div class="row">
            @foreach(App\Models\Tag::all() as $tag)
                <div class="form-check col-3 tagsTable">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->id }}" name="{{ $tag->id }}" >
                    <label class="form-check-label" for="{{ $tag->id }}">{{ $tag->tagname }}</label>
                </div>
            @endforeach
        </div>
        <br>
        <div class="buttons">
            <button type="submit" class="btn outlined">Delete Selected Tags</button>
            <p><a href="{{ route('tags.page') }}" class="btn">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection