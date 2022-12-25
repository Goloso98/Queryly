@extends('layouts.app')

@section('content')
    <br>
    <h2 class="text-center">Our Users</h2>
    <br>
    <div class="row">
        <div class="column" style="width: 50%">
            @include('partials.emsearchbar')
        </div>
    </div>
    
    <br>

    <ul>
        @foreach($users as $user)
            @include('partials.user', ['showUser' => TRUE])
        @endforeach
    </ul>

@endsection