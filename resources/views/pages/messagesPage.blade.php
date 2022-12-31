@extends('layouts.app')

@section('content')
    <div class="flash-message">
        <br>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <br>
    <h2 class="centering">Messages</h2>
    <hr>
    <br>

    @forelse($messages as $message)
        @include('partials.message')
    @empty
        <p class="centering">No messages.</p>
    @endforelse

@endsection