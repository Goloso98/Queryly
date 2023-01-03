@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <form method="post" action="{{ route('posts.editTags', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <br>
        <h2 class="centering">Edit Question Tags</h2>
        <hr>
        <br>
        <div class="row">
            @foreach(App\Models\Tag::select( DB::raw('id, tagname, UPPER(tagName) as name') )->orderBy('name', 'ASC')->get() as $tag)
                <div class="form-check col-3 centering">
                    @if(!($post->tags->contains($tag->id)))
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" >
                            <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" checked>
                            <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
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