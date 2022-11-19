@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    <p></p>
    <ul>
        @each('partials.question', $questions, 'question')
    </ul>

@endsection