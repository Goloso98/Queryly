@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@if(Auth::id() == $user->id)
  <h2 class="text-center">Your Badges</h2>
@else
  <h2 class="text-center">{{ $user->username }}'s Badges</h2>
@endif<br>
<ul>
  @forelse($badges as $badge)
    @include('partials.badge')
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You don't own any badges yet.</p>
    @else
      <p class="info-message">{{ $user->username }} doesn't own any badges yet.</p>
    @endif
  @endforelse
</ul>

@endsection