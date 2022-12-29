@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@php
  $counter = DB::table('posts')->where('userid', $user->id)->where('posttype', 'question')->count();
@endphp
@if(Auth::id() == $user->id)
  <h2 class="centering">Your Questions ({{ $counter }})</h2>
@else
  <h2 class="centering">{{ $user->username }}'s Questions ({{ $counter }})</h2>
@endif
<hr>
<br>
<ul>
  @forelse($questions as $question)
    @include('partials.question', ['showUser' => FALSE])
  @empty
    @if(Auth::id() == $user->id)
      <p class="centering">You haven't posted any questions yet.</p>
    @else
      <p class="centering">{{ $user->username }} hasn't posted any questions yet.</p>
    @endif
  @endforelse
</ul>

@endsection

