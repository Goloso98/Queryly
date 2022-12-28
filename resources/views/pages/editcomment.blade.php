@extends('layouts.app')

@section('title', $comment->id)

@section('content')
    <form method="post" action="{{ route('comments.edit', $comment->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <br>
        <h2 class="text-center">Edit your comment</h2>
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
        <br>
        <div id="buttons">
            <button type="submit" class="btn text-center" id="outlined">
                Save Changes
            </button>
            @php
                $postType = DB::table('posts')->find($comment->postid)->posttype;
            @endphp
            @if($postType == 'question')
                <p><a href="{{ route('posts.postPage', $comment->postid) }}" class="btn">Cancel</a></p>
            @else
                @php
                    $postID = DB::table('posts')->find($comment->postid)->parentpost;
                @endphp
                <p><a href="{{ route('posts.postPage', $postID) }}" class="btn">Cancel</a></p>
            @endif
        </div>
        <br>
    </form>
@endsection