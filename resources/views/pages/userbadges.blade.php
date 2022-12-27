@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="text-center">Your Badges ({{ $badges->count() }})</h2>
@else
  <h2 class="text-center">{{ $user->username }}'s Badges ({{ $badges->count() }})</h2>
@endif
<br>

<div class="row">
  @forelse($badges as $badge)
    <div class="col-3">
      <button type="button" class="btn btn-primary" id="badgeLabel">{{ $badge->badgename }}</button>
    </div>
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You don't own any badges yet.</p>
    @else
      <p class="info-message">{{ $user->username }} doesn't own any badges yet.</p>
    @endif
  @endforelse
</div>
<br>

@endsection