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
    <h2 class="centering">Search Results ({{ $length }})</h2>
    <hr>
    <br>
    @include('partials.searchbar', ['userSearch' => $userSearch])
    <br>
    
    @if(!$userSearch)
        <ul>
            @forelse($posts as $post)
                @if($post->posttype == 'question')
                    @php
                        $question = $post;
                    @endphp
                    @include('partials.question', ['showUser' => TRUE, 'report' => FALSE])
                @else
                    @php
                        $answer = $post;
                    @endphp
                    @include('partials.answer', ['showTitle' => TRUE, 'report' => FALSE])
                @endif
            @empty
                <p class="centering">No results found</p>
            @endforelse
        </ul>
    @else
        <ul>
            @forelse($users as $user)
                @include('partials.user', ['profile' => false])
            @empty
                <p class="centering">No results found</p>
            @endforelse
        </ul>
    @endif
@endsection