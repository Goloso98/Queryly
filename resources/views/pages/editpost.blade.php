@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <form method="post" action="{{ route('posts.edit', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        @if (($post->posttype) == 'question')
            <h3>Edit your question</h3>
        @else
            <h3>Edit your answer</h3>
        @endif
        <br>
        @if (($post->posttype) == 'question')
            <div class="mb-3">
                <h4>Title</h4>
                @if ($errors->has('title'))
                    <span class="error">
                        {{ $errors->first('title') }}
                    </span>
                @endif
                <textarea name="title" id="title" class="form-control" rows="2">{{$post->title}}</textarea>
            </div>
        @endif
        <div class="mb-3">
            <h5>Text</h5>
            @if ($errors->has('postText'))
                <span class="error">
                    {{ $errors->first('postText') }}
                </span>
            @endif
            <textarea name="postText" id="postText" class="form-control" rows="8">{{$post->posttext}}</textarea>
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