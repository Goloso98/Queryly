@extends('layouts.app')

@section('title', $user->name)

@section('content')

<form method="post" action="{{ route('changeTags', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <br>
    <h2 class="centering">Follow (or Unfollow) Tags:</h2>
    <br>
    <div class="row">
        @foreach(App\Models\Tag::all() as $tag)
            <div class="form-check col-3 centering">
                @if(!($user->tags->contains($tag->id)))
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
            Update Tags
        </button>
        <p><a href="{{ route('users.tags', $user->id) }}" class="btn">Cancel</a></p>
    </div>
    <br>
</form>



@endsection