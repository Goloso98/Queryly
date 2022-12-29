@extends('layouts.app')

@section('title', Auth::id())

@section('content')
<br>
<h2 class="centering">Manage Reports</h2>
<hr>
<br>
@forelse($reports as $report)
    <div class="card">
        <div class="card-body">
            <article class="rport" data-id="{{$report->id}}">
                <h3>Report by: {{ App\Models\User::find($report->userid)->name }}</h3>
                <p><a class="delete btn" id="delete-report" href="#">Delete Report</a></p>
                @if($report->reporttype == 'post')
                    @if(App\Models\Post::find($report->postid)->posttype == 'question')
                        @include('partials.question', ['question' => App\Models\Post::find($report->postid), 'showUser' => TRUE, 'report' => TRUE])
                    @else
                        @include('partials.answer', ['answer' => App\Models\Post::find($report->postid), 'showTitle' => TRUE, 'report' => TRUE])
                    @endif
                @else
                    @include('partials.comment', ['comment' => App\Models\Comment::find($report->commentid), 'report' => TRUE])
                @endif
            </article>
        </div>
    </div>
    <br>
@empty 
<p class="centering">No reports.</p>
@endforelse

@endsection