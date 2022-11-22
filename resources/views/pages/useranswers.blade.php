@extends('layouts.app')

@section('title', $user->name)

@section('content')
<ul>
  @foreach($answers as $answer)
    @include('partials.answer', ['showTitle' => TRUE])
  @endforeach
</ul>

@endsection