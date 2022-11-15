@extends('layouts.app')

@section('title', $user->name)

@section('content')
  @include('partials.useredit', ['user' => $user])
@endsection

