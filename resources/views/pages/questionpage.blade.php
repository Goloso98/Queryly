@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <article class="post" data-id="{{ $question->id }}">
    <header>
        <h2>Title: {{ $question->title }} </h2>
    </header>
    <p> {{ $question->posttext }} </p>
    <p> {{ $question->postdate }} </p>
    <p> Autor: {{ $question->user()->first()->username }}</p>
    </article>
    <p></p>
    <header>
        <h3>Answers: </h3>
    </header>
@endsection