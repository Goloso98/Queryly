@extends('layouts.app')

@section('title')

@section('content')
<br>
<h2 class="centering">Blocked Users</h2>
<hr>
<br>
<ul>
    @forelse($users as $user)
        @include('partials.user', ['profile' => false])
    @empty
        <p class="centering">There are no blocked users.</p>
    @endforelse
</ul>

@endsection