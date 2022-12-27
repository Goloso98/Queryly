@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <br>
    <h3>Existing Tags:</h3>
    @foreach($tags as $tag)
        <p>{{ $tag->tagname }}</p>
    @endforeach
    <a class="btn" aria-current="page" href="{{ route('tags.addForm') }}">Add Tags</a>
    <a class="btn" aria-current="page" href="{{ route('tags.deleteForm') }}">Delete Tags</a>
@endsection