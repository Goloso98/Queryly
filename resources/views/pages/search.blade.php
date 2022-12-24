@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    
    <ul>
        @forelse($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @empty
            <p>No results found</p>
        @endforelse
    </ul>

@endsection