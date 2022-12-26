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
                <textarea name="title" id="postTitle" class="form-control" rows="2">{{$post->title}}</textarea>
                @php
                    $length = strlen($post->title);
                @endphp
                <div id="count-postTitle">
                    <span id="current-postTitle">{{ $length }}</span>
                    <span id="maximum-postTitle">/ 1000</span>
                </div>
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
            @php
                $length = strlen($post->posttext);
            @endphp
            <div id="count-postText">
                <span id="current-postText">{{ $length }}</span>
                <span id="maximum-postText">/ 1000</span>
            </div>
        </div>
        @if (($post->posttype) == 'question')
            <div class="mb-3">
                <h5>Tags</h5>
                @foreach($post->tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" checked>
                        <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                    </div>
                @endforeach
                @foreach(App\Models\Tag::all() as $tag)
                    @if(!($post->tags->contains($tag->id)))
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" >
                        <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="text-center">
            <button type="submit">
                Save Changes
            </button>
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection