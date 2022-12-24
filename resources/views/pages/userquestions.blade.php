@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<h2 class="text-center">Your Questions</h2>
<p></p>
<ul>
  @forelse($questions as $question)
    @include('partials.question', ['showUser' => FALSE])
  @empty
    <p class="info-message">You haven't posted any questions yet.</p>
  @endforelse
</ul>

@endsection

