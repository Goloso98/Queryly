@extends('layouts.app')

@section('content')
    @php
        $length = $posts->count();;
    @endphp
    <br>
    <h2 class="text-center">Search Results ({{ $length }})</h2>
    <br>
    @include('partials.emsearchbar')
    
    <ul>
        @forelse($posts as $post)
            @if($post->posttype == 'question')
                @php
                    $question = $post;
                @endphp
                @include('partials.question', ['showUser' => TRUE])
            @else
                @php
                    $answer = $post;
                @endphp
                @include('partials.answer', ['showTitle' => TRUE])
            @endif
        @empty
            <p>No results found</p>
        @endforelse
    </ul>

@endsection