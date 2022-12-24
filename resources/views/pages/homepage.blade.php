@extends('layouts.app')

@section('content')
    <br>
    <h2 class="text-center">Homepage</h2>
    <br>
    <div class="row">
        <div class="column" style="width: 50%">
            @include('partials.emsearchbar')
        </div>
    </div>
    
    <br>

    <ul>
        @foreach($questions as $question)
            @include('partials.question', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection