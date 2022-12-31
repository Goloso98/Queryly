@extends('layouts.app')

@section('title')

@section('content')
<br>
<h2 class="centering">Blocked Users</h2>
<hr>
<br>
<ul>
    @forelse($users as $user)
        @include('partials.user')
    @empty
        <p class="centering">There are no blocked users.</p>
    @endforelse
</ul>

<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>

@endsection