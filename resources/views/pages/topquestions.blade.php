@extends('layouts.app')

@section('content')

    <ul>
        @foreach($questionStars as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection