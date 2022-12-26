@extends('layouts.app')

@section('content')
    @if(!$userSearch)
        @php
            $length = $posts->count();;
        @endphp
    @else
        @php
            $length = $users->count();;
        @endphp
    @endif
    <br>
    <h2 class="text-center">Search Results ({{ $length }})</h2>
    <br>
    @include('partials.searchbar', ['userSearch' => $userSearch])
    
    @if(!$userSearch)
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
    @else
        <ul>
            @forelse($users as $user)
                @include('partials.user')
            @empty
                <p>No results found</p>
            @endforelse
        </ul>
    @endif

@endsection