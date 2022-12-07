@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<h2 class="text-center">Your Answers</h2>
<p></p>
<ul>
  @foreach($answers as $answer)
    @include('partials.answer', ['showTitle' => TRUE])
  @endforeach
</ul>

@endsection