@extends('layouts.app')

@section('title', Auth::id())

@section('content')
<br>
@forelse($reports as $report)
    <article class="rport" data-id="{{$report->id}}">

        <h3>Report by: {{ App\Models\User::find($report->userid)->name }}</h3>
        <p><a class="delete" id="delete-report" href="#">Delete Report</a></p>
        @if($report->reporttype == 'post')
            @if(App\Models\Post::find($report->postid)->posttype == 'question')
                @include('partials.question', ['question' => App\Models\Post::find($report->postid), 'showUser' => FALSE])
            @else
                @include('partials.answer', ['answer' => App\Models\Post::find($report->postid), 'showTitle' => TRUE])
            @endif
        @else
            @include('partials.comment', ['comment' => App\Models\Comment::find($report->commentid)])
        @endif
    
    </article>
@empty 
<p class="centering">No reports.</p>
@endforelse

@endsection