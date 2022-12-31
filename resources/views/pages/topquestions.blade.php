@extends('layouts.app')

@section('content')
    <br>
    <h2 class="centering">Top 10 Questions</h2>
    <hr>
    <br>
    <ul>
        @foreach($questionStars as $question)
            @include('partials.question', ['showUser' => TRUE, 'report' => FALSE])
        @endforeach
    </ul>

    <button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>

@endsection