@extends('layouts.app')

@section('content')
    <br>
    <h2 class="centering">Homepage</h2>
    <hr>
    <br>
    @include('partials.searchbar', ['userSearch' => FALSE])
    
    
    <br>
    @forelse($questions as $question)
        @include('partials.question', ['showUser' => TRUE, 'report' => FALSE])
    @empty
        <p class="centering">There are no questions yet. :(</p>
    @endforelse

@endsection