@extends('layouts.app')

@section('content')
    <br><br>
    <h2 class="centering">Top 10 Questions</h2>
    <hr>
    <br>
    @foreach($questionStars as $question)
        @include('partials.question', ['showUser' => TRUE, 'report' => FALSE])
    @endforeach

@endsection