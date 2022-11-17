@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <article class="post" data-id="{{ $question->id }}">
    <header>
        <h2>Title: {{ $question->title }} </h2>
    </header>
    <p> {{ $question->posttext }} </p>
    <p> {{ $question->postdate }} </p>
    <p> Arranjar forma de ver o nome do user {{ $question->userid }}</p>
    </article>
    <p></p>
    <header>
        <h2>Answers: </h2>
    </header>
@endsection