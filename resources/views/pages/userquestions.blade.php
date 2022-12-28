@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@php
  $counter = DB::table('posts')->where('userid', $user->id)->where('posttype', 'question')->count();
@endphp
@if(Auth::id() == $user->id)
  <h2 class="info-message">Your Questions ({{ $counter }})</h2>
@else
  <h2 class="info-message">{{ $user->username }}'s Questions ({{ $counter }})</h2>
@endif
<br>
<ul>
  @forelse($questions as $question)
    @include('partials.question', ['showUser' => FALSE])
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You haven't posted any questions yet.</p>
    @else
      <p class="info-message">{{ $user->username }} hasn't posted any questions yet.</p>
    @endif
  @endforelse
</ul>

@endsection

