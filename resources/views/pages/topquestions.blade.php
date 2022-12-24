@extends('layouts.app')

@section('content')
    <br>
    <h2 class="page-header">Top Questions</h2>
    <br>
    <ul>
        @foreach($questionStars as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection