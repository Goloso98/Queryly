@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="text-center">Your Followed Tags</h2>
@else
  <h2 class="text-center">{{ $user->username }}'s Followed Tags</h2>
@endif<br>

<ul>
  @forelse($tags as $tag)
    @include('partials.tag')
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You don't own any tags yet.</p>
    @else
      <p class="info-message">{{ $user->username }} doesn't own any tags yet.</p>
    @endif
  @endforelse
</ul>

@if(Auth::id() == $user->id)
    <form method="post" action="{{ route('users.changeTags', $user->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <h2 class="text-center">Follow (or Unfollow) Tags:</h2>
        <div class="mb-3">
            @foreach($user->tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" checked>
                    <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                </div>
            @endforeach
            @foreach(App\Models\Tag::all() as $tag)
                @if(!($user->tags->contains($tag->id)))
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}" >
                        <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="text-center">
            <button type="submit">
                Save Changes
            </button>
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </form>
@endif


@endsection