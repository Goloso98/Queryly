@inject('post', 'App\Http\Controllers\PostController')
@inject('user', 'App\Http\Controllers\UserController')
@inject('comment', 'App\Http\Controllers\CommentController')

@extends('layouts.app')

@section('title', $question->title)

@section('content')
<br>
<article class="post" data-id="{{ $question->id }}" user-id="{{Auth::id()}}">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Title: {{ $question->title }}</h2>
            @can('delete', $question)
                <a class="delete" id="delete-post" href="#"> Delete Question </a>
            @endcan
            @can('update', $question)
                <a class="btn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
            @endcan
            <p class="card-text">{{ $question->posttext }}</p>
            {{ $question->postdate }}
            <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{ $question->user()->first()->username }}</a>
            @if( $question->edited )<p>Edited</p>@endif
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
                    <i class="fa-solid fa-star star">&nbsp;{{ count($stars) }}</i>  
                @else
                    <i class="fa-regular fa-star star">&nbsp;{{ count($stars) }}</i>  
                @endif
            @else
            <i class="fa-regular fa-star">&nbsp;{{ count($stars) }}</i>
            @endif

            <h5>Tags:</h5> 
            @php
                $tags = $question->tags;
            @endphp
            @foreach ($tags as $tag)
                <p>{{ $tag->tagname }}</p>
            @endforeach
        </div>
    </div>
    @php
        $questionComments = app\Http\Controllers\CommentController::showComments($question->id);
    @endphp
    <br>
    <div class="flex-header">
        <h5>Comments: ({{count($questionComments)}})</h5>
        <a class="btn" aria-current="page" href="{{route('addComment', $question->id)}}">Add Comment</a>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Show Comments
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @foreach($questionComments as $comment)
                        @include('partials.comment')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</article>

<br>
<header>
    @php
        $answers = app\Http\Controllers\PostController::showAnswers($question->id);
    @endphp
    <div class="flex-header">
        <h3>Answers: ({{count($answers)}})</h3>
        <a class="btn" aria-current="page" href="{{ route('addAnswer') }}?question={{$question->id}}"> Post Answer </a>
    </div>
</header>
<br>
<ul>
    @foreach($answers as $answer)
        @include('partials.answer', ['showTitle' => FALSE])
    @endforeach
</ul>

@endsection