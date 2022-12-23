@extends('layouts.app')

@section('content')
    @include('partials.emsearchbar')
    
    <ul>
        @if($searchfor == 'questions')
            @foreach($questions as $question)
                @foreach($questionsTag as $questionT)
                    @if($question->id === $questionT->id)
                        @include('partials.question', ['showUser' => TRUE])~
                    @endif
                @endforeach
            @endforeach
        @endif
    </ul>

@endsection