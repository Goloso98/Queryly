@extends('layouts.app')

@section('content')
    <br>
    <h2 class="text-center">Top 10 Questions</h2>
    <br>
    <ul>
        @foreach($questionStars as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection