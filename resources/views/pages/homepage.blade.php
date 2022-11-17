@extends('layouts.app')

@section('content')
    <ul>
        @each('partials.question', $questions, 'question')
    </ul>

@endsection