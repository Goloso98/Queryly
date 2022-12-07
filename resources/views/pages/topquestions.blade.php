@extends('layouts.app')

@section('content')
    <p></p>
    <h2 class="page-header">Top Questions</h2>
    <p></p>
    <ul>
        @foreach($questionStars as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection