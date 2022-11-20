@inject('post', 'App\Http\Controllers\PostController')
@inject('user', 'App\Http\Controllers\UserController')

@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <article class="post" data-id="{{ $question->id }}">
    <header>
        <h2>Title: {{ $question->title }} </h2>
        @php
            $role = app\Http\Controllers\UserController::showRole();
        @endphp
        @if ($role == 'Administrator' && Auth::id() != $question->userid)
            <a class="delete" href="#"> Delete Question </a>
        @endif
        @if (Auth::id() == $question->userid)
            <a class="delete" href="#"> Delete Question </a>
            <a class="btn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
            @endif
    </header>
    <p> {{ $question->posttext }} </p>
    <p> {{ $question->postdate }} </p>
    <p> <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{ $question->user()->first()->username }}</a></p>
    </article>
    <p></p>
    <header>
        @php
            $answers = app\Http\Controllers\PostController::showAnswers($question->id);
        @endphp
        <h3>Answers: ({{count($answers)}})</h3>
        <a class="btn" aria-current="page" href="{{ route('posts.addAnswer') }}?question={{$question->id}}"> Post Answer </a>
    </header>
    <ul>
        @foreach($answers as $answer)
            @include('partials.answer', ['showTitle' => FALSE])
        @endforeach
    </ul>
    
@endsection