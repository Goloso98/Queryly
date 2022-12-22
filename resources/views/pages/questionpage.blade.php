@inject('post', 'App\Http\Controllers\PostController')
@inject('user', 'App\Http\Controllers\UserController')

@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <p></p>
    <article class="post" data-id="{{ $question->id }}" user-id="{{Auth::id()}}">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Title: {{ $question->title }}</h2>
                <p>
                    <a href="{{route('posts.comments', $question->id)}}">Comments</a>
                    <a href="{{route('addComment', $question->id)}}">Comment Question</a>
                </p>

                @can('delete', $question)
                    <a class="delete" href="#"> Delete Question </a>
                @endcan
                @can('update', $question)
                    <a class="btn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
                @endcan
                <p class="card-text">{{ $question->posttext }}</p>
                {{ $question->postdate }}
                <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{ $question->user()->first()->username }}</a>
                <br>
                @php
                $stars = DB::table('stars')->where('postid', $question->id)->get();
            @endphp
            @if(Auth::check())
                @php
                    $userStar = false;
                    for($i = 0; $i < count($stars); $i++){
                        if($stars[$i]->userid === Auth::id()) $userStar = true;
                    }
                @endphp
                @if($userStar)
                    <i class="fa-solid fa-star star">{{ count($stars) }}</i>  
                @else
                    <i class="fa-regular fa-star star">{{ count($stars) }}</i>  
                @endif
            @else
               <i class="fa-regular fa-star">{{ count($stars) }}</i>
            @endif
            @php
                $tags = $question->tags;
            @endphp
            @foreach ($tags as $tag)
                <p>$tag->tagname</p>
            @endforeach
            </div>
        </div>
    </article>

    <p></p>
    <header>
        @php
            $answers = app\Http\Controllers\PostController::showAnswers($question->id);
        @endphp
        <h3>Answers: ({{count($answers)}})</h3>
        <a class="btn" aria-current="page" href="{{ route('posts.addAnswer') }}?question={{$question->id}}"> Post Answer </a>
    </header>
    <p></p>
    <ul>
        @foreach($answers as $answer)
            @include('partials.answer', ['showTitle' => FALSE])
        @endforeach
    </ul>

@endsection