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
    <h2 class="centering">Our Users</h2>
    <hr>
    <br>
    @include('partials.searchbar', ['userSearch' => TRUE])
    
    <br>

    <ul>
        @foreach($users as $user)
            @include('partials.user')
        @endforeach
    </ul>

@endsection