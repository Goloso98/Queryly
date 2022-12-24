@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<h2 class="text-center">Your Answers</h2>
<p></p>
<ul>
  @forelse($answers as $answer)
    @include('partials.answer', ['showTitle' => TRUE])
  @empty
    <p class="info-message">You haven't posted any answers yet.</p>
  @endforelse
</ul>

@endsection