@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <form method="post" action="{{ route('tags.deleteForm') }}">
        {{ csrf_field() }}
        <h2 class="centering">Delete Tags</h2>
        <hr>
        <br>
        <div class="row">
            @foreach(App\Models\Tag::select( DB::raw('id, tagname, UPPER(tagName) as name') )->orderBy('name', 'ASC')->get() as $tag)
                <div class="form-check col-3 centering">
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