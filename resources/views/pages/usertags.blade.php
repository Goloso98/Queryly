@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="info-message">Your Followed Tags ({{ $tags->count() }})</h2>
@else
  <h2 class="info-message">{{ $user->username }}'s Followed Tags ({{ $tags->count() }})</h2>
@endif<br>

<div class="text-center">
  <a class="btn" id="outlined" aria-current="page" href="{{ route('changeTags', $user->id) }}">Update Followed Tags</a>
</div>
<br>
<div class="row">
  @forelse($tags as $tag)
    <div class="form-check col-3" id="tagsTable">
      {{ $tag->tagname }}
    </div>
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You don't follow any tags yet.</p>
    @else
      <p class="info-message">{{ $user->username }} doesn't follow any tags yet.</p>
    @endif
  @endforelse
</div>
<br>

@endsection