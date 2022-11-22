@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    
    <ul>
        @if($searchfor == 'questions')
            @foreach($questions as $question)
                @include('partials.question', ['showUser' => TRUE])
            @endforeach
        @endif
        @if($searchfor == 'users')
            @each('partials.userforhome', $users, 'user')
        @endif
    </ul>

@endsection