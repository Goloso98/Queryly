@extends('layouts.app')

@section('content')
    <br>
    <h2 class="centering">Homepage</h2>
    <br>
    @include('partials.searchbar', ['userSearch' => FALSE])
    
    
    <br>

    <ul>
        @foreach($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection