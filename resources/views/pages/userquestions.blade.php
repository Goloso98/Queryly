@extends('layouts.app')

@section('title', $user->name)

@section('content')
<ul>
  @each('partials.question', $questions, 'question')
</ul>

@endsection

