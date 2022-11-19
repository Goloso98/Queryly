@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    <p></p>
    <ul>
        @if($searchfor == 'Questions')
            @each('partials.question', $questions, 'question')
        @endif
        @if($searchfor == 'Users')
            @each('partials.userforhome', $users, 'user')
        @endif
        @if($searchfor == 'Both')
            @each('partials.question', $questions, 'question')
            @each('partials.userforhome', $users, 'user')
        @endif
    </ul>

@endsection