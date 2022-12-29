@extends('layouts.app')

@section('content')
    <br>
    <h2 class="centering">Homepage</h2>
    <br>
    @include('partials.searchbar', ['userSearch' => FALSE])
    
    
    <br>

    <ul>
        @forelse($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @empty
            <p class="centering">There are no questions yet. :(</p>
        @endforelse
    </ul>

@endsection