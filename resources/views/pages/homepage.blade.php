@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    <p></p>
    <ul>
        @foreach($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection