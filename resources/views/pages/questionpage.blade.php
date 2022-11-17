@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <article class="post" data-id="{{ $question->id }}">
    <header>
        <h2>Title: {{ $question->title }} </h2>
        @if (Auth::id() == $question->userid)
            <a class="delete" href="#"> Delete Question </a>
        @endif
    </header>
    <p> {{ $question->posttext }} </p>
    <p> {{ $question->postdate }} </p>
    <p> {{ $question->user()->first()->username }}</p>
    </article>
    <p></p>
    <header>
        <h3>Answers: </h3>
    </header>
@endsection