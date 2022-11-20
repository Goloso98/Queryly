@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    <p></p>
    <ul>
        @if($searchfor == 'Questions')
            @foreach($questions as $question)
                @include('partials.question', ['showUser' => TRUE])
            @endforeach
        @endif
        @if($searchfor == 'Users')
            @each('partials.userforhome', $users, 'user')
        @endif
        @if($searchfor == 'Both')
            @foreach($questions as $question)
                @include('partials.question', ['showUser' => TRUE])
            @endforeach
            @each('partials.userforhome', $users, 'user')
        @endif
    </ul>

@endsection