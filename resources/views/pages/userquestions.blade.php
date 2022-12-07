@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<h2 class="text-center">Your Questions</h2>
<p></p>
<ul>
  @foreach($questions as $question)
    @include('partials.question', ['showUser' => FALSE])
  @endforeach
</ul>

@endsection

