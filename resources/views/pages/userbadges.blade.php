@extends('layouts.app')

@section('title', $user->name)

@section('content')
<p></p>
<ul>
  @foreach($badges as $badge)
    @include('partials.badge')
  @endforeach
</ul>

@endsection