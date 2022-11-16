@extends('layouts.app')

@section('title', $user->name)

@section('content')
<ul>
  @each('partials.answer', $answers, 'answer')
</ul>

@endsection