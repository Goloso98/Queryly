@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="centering">Your Badges ({{ $badges->count() }})</h2>
@else
  <h2 class="centering">{{ $user->username }}'s Badges ({{ $badges->count() }})</h2>
@endif
<hr>
<br>

<div class="row">
  @forelse($badges as $badge)
    <div class="col-3">
      <button type="button" class="btn btn-primary badgeLabel">{{ $badge->badgename }}</button>
    </div>
  @empty
    @if(Auth::id() == $user->id)
      <p class="centering">You don't own any badges yet.</p>
    @else
      <p class="centering">{{ $user->username }} doesn't own any badges yet.</p>
    @endif
  @endforelse
</div>
<br>

@endsection