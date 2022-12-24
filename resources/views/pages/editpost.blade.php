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
                <textarea name="title" id="title" class="form-control" rows="2">{{ $post->title }}</textarea>
            </div>
        @endif
        <div class="mb-3">
            <h5>Text</h5>
            <textarea name="posttext" id="posttext" class="form-control" rows="8">{{ $post->posttext }}</textarea>
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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
@endsection