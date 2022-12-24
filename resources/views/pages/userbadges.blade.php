@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
<h2 class="text-center">Your Badges</h2>
<br>
<ul>
  @forelse($badges as $badge)
    @include('partials.badge')
  @empty
    <p class="info-message">You own any badge yet.</p>
  @endforelse
</ul>

@endsection