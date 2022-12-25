@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
@php
  $counter = DB::table('posts')->where('userid', $user->id)->where('posttype', 'answer')->count();
@endphp
@if(Auth::id() == $user->id)
  <h2 class="text-center">Your Answers ({{ $counter }})</h2>
@else
  <h2 class="text-center">{{ $user->username }}'s Answers ({{ $counter }})</h2>
@endif
<br>
<ul>
  @forelse($answers as $answer)
    @include('partials.answer', ['showTitle' => TRUE])
  @empty
    @if(Auth::id() == $user->id)
      <p class="info-message">You haven't posted any answers yet.</p>
    @else
      <p class="info-message">{{ $user->username }} hasn't posted any answers yet.</p>
    @endif
  @endforelse
</ul>

@endsection