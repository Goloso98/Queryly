@extends('layouts.app')

@section('title', $user->name)

@section('content')
  @include('partials.user', ['user' => $user])
@endsection