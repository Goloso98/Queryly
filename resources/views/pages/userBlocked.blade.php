@extends('layouts.app')

@section('title')

@section('content')
@php
  $counter = DB::table('users')->where('isblocked', 'true')->count();
@endphp
<br>
<h2 class="centering">Blocked Users ({{ $counter }})</h2>
<hr>
<br>
@forelse($users as $user)
    @include('partials.user', ['profile' => false])
@empty
    <p class="centering">There are no blocked users.</p>
@endforelse

@endsection