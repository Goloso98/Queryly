@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <form method="post" action="{{ route('posts.editTags', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
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
        <br>
        <div class="buttons">
            <button type="submit" class="btn outlined">
                Update tags
            </button>
            <p><a href="{{ route('posts.postPage', $post->id) }}" class="btn">Cancel</a></p>
        </div>
        <br>
    </form>
@endsection