@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="centering">Your Followed Tags ({{ $tags->count() }})</h2>
@else
  <h2 class="centering">{{ $user->username }}'s Followed Tags ({{ $tags->count() }})</h2>
@endif<br>

<div class="centering">
  <a class="btn outlined" aria-current="page" href="{{ route('changeTags', $user->id) }}">Update Followed Tags</a>
</div>
<br>
<div class="row">
  @forelse($tags as $tag)
    <div class="form-check col-3 centering">
      <button type="button" class="btn btn-primary badgeLabel">{{ $tag->tagname }}</button>
    </div>
  @empty
    @if(Auth::id() == $user->id)
      <p class="centering">You don't follow any tags yet.</p>
    @else
      <p class="centering">{{ $user->username }} doesn't follow any tags yet.</p>
    @endif
  @endforelse
</div>
<br>

@endsection