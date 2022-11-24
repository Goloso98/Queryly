@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<ul>
  @foreach($answers as $answer)
    @include('partials.answer', ['showTitle' => TRUE])
  @endforeach
</ul>

@endsection