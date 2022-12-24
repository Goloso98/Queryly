@extends('layouts.app')

@section('title', $user->name)

@section('content')
<br>
<h2 class="text-center">Your Questions</h2>
<br>
<ul>
  @forelse($questions as $question)
    @include('partials.question', ['showUser' => FALSE])
  @empty
    <p class="info-message">You haven't posted any questions yet.</p>
  @endforelse
</ul>

@endsection

