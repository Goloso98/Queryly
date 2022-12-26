@extends('layouts.app')

@section('content')
    <br>
    <h2 class="text-center">Our Users</h2>
    <br>
    @include('partials.searchbar', ['userSearch' => TRUE])
    
    <br>

    <ul>
        @foreach($users as $user)
            @include('partials.user')
        @endforeach
    </ul>

@endsection