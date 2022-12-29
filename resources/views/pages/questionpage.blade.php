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
            <div class="row align">
                <br>
                <div class="col-8">
                    @can('delete', $question)
                        <a class="delete btn" id="delete-post" href="#"> Delete Question </a>
                    @endcan
                    @can('update', $question)
                        <a class="btn cardBtn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
                    @endcan
                    @can('updateTags', $question)
                        <a class="btn cardBtn" aria-current="page" href="{{  route('posts.editTags', $question->id)  }}">Edit Tags</a>
                    @endcan
                </div>
                <div class="col-4">
                    @if(Auth::check() && Auth::id() != $question->userid)
                        <form method="post" action="{{ route('posts.follow', $question->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn followBtn">
                            @if(Auth::user()->isFollowingPost($question->id))
                                Unfollow Question
                            @else
                                Follow Question
                            @endif
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <br>
            <p class="card-text">{{ $question->posttext }}</p>
            @if( $question->edited )
                <span class="editedLabel">(edited)</span>
                <br>
            @endif
            {{ $question->postdate }}
            <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{ $question->user()->first()->username }}</a>
            @if(Auth::check())
            <form method="post" action="{{ route('posts.report', $question->id) }}">
                {{ csrf_field() }}
                <button type="submit" class="btn cardBtn report"> Report Question </button>
            </form>
            @endif
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
            @php
                $tags = $question->tags;
            @endphp
            @if($tags->count() != 0)
                <p></p> <!-- br does not work -->
                <div class="accordion" id="accordionQTags">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTag">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTag" aria-expanded="true" aria-controls="collapseTag">
                            Tags
                        </button>
                    </h2>
                    <div id="collapseTag" class="accordion-collapse collapse" aria-labelledby="headingTag" data-bs-parent="#accordionQTags">
                        <div class="accordion-body">
                                <div class="container centering">
                                    <div class="row">
                                        @php
                                            $tags = $question->tags;
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <div class="form-check col-4">
                                                {{ $tag->tagname }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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