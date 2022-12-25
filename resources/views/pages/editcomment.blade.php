@extends('layouts.app')

@section('title', $comment->id)

@section('content')
    <form method="post" action="{{ route('comments.edit', $comment->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <h3>Edit your comment</h3>
        <br>
        <div class="mb-3">
            <h5>Text</h5>
            @if ($errors->has('commenttext'))
                <span class="error">
                    {{ $errors->first('commenttext') }}
                </span>
            @endif
            <textarea name="commenttext" id="commentText" class="form-control" rows="8">{{ $comment->commenttext }}</textarea>
            @php
                $length = strlen($comment->commenttext);
            @endphp
            <div id="count-commentText">
                <span id="current-commentText">{{ $length }}</span>
                <span id="maximum-commentText">/ 250</span>
            </div>
        </div>

        <div class="text-center">
            <button type="submit">
                Save Changes
            </button>
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection