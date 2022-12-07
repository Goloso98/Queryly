@extends('layouts.app')

@section('content')
    <p></p>
    <h2 class="text-center">Homepage</h2>
    <p></p>
    <div class="row">
        <div class="column" style="width: 50%">
            @include('partials.emsearchbar')
        </div>
    </div>
    
    <p></p>

    <ul>
        @foreach($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection