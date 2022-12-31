@extends('layouts.app')

@section('content')
    <br>
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
    <br>
    <h2 class="centering">Homepage</h2>
    <hr>
    <br>
    @include('partials.searchbar', ['userSearch' => FALSE])
    
    
    <br>
    @forelse($questions as $question)
        @include('partials.question', ['showUser' => TRUE, 'report' => FALSE])
    @empty
        <p class="centering">There are no questions yet. :(</p>
    @endforelse
    <button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>

@endsection