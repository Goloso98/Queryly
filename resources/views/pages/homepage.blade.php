@extends('layouts.app')

@section('content')
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