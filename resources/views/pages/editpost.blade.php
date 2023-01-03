@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <form method="post" action="{{ route('posts.edit', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <br>
        @if (($post->posttype) == 'question')
            <h2 class="centering">Edit your question</h2>
        @else
            <h2 class="centering">Edit your answer</h2>
        @endif
        <hr>
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
            <br>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endif
        <br>
        <div class="buttons">
            <button type="submit" class="btn outlined">
                Save Changes
            </button>
            @if($post->posttype == 'question')
                <p><a href="{{ route('posts.postPage', $post->id) }}" class="btn">Cancel</a></p>
            @else
                <p><a href="{{ route('posts.postPage', $post->parentpost) }}" class="btn">Cancel</a></p>
            @endif
        </div>
        <br>
    </form>
@endsection