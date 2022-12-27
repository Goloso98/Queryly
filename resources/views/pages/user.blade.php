@extends('layouts.app')

@section('title', $user->name)

@section('content')
  <article class="userbuttons" data-id="{{ $user->id }}">
    @php
      $role = app\Http\Controllers\UserController::showRole();
      $roleAdmin = $role->contains(function($item){
          return $item->userrole === 'Administrator';
        });
      $roleMod = $role->contains(function($item){
          return $item->userrole === 'Moderator';
        });
      $roleText = '(';
      if($roleAdmin) $roleText = $roleText.'Administrator';
      if($roleMod) $roleText = $roleText.', Moderator';
      $roleText = $roleText.')';
    @endphp
    <br>

    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->

    <div>
      <div class="col">
        <img src="{{ $user->avatar }}" class="rounded float-end" style="width: 20%" alt="description of myimage">
      </div>
      <div class="col">
        <header>
          <h2>{{ $user->name }}</h2>
          @if(($roleAdmin || $roleMod) && Auth::user() == $user)
            <p class="role">{{ $roleText }}</p>
          @endif
        </header>
        <p>&#64;{{ $user->username }}</p>
        <p>e-mail: {{ $user->email }}</p>
        <p>Age: {{$age}}</p>
      </div>
    </div>
    <hr>

    @if(Auth::check() && Auth::user() == $user)
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <p><a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> My questions </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> My answers </a></p>
          </div>
          <div class="col">
            <p><a class="btn" aria-current="page" href="{{ route('users.tags', $user->id) }}"> See Followed Tags </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.badges', $user->id) }}"> My Badges </a></p>
          </div>
        </div>
        @if($roleMod)
        <div class="row">
          <p><a class="btn" aria-current="page" href="{{ route('tags') }}"> Manage Tags </a></p>
        </div>
        @endif
      </div>
      <hr>
      <div class="text-center">
        <p><a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a></p>
        <p><a class="delete" href="#"> Delete My Account </a></p>
      </div>
    @else
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <p><a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> See questions </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> See answers </a></p>
          </div>
          <div class="col">
            <p><a class="btn" aria-current="page" href="#"> See Followed Tags </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.badges', $user->id) }}"> See Badges </a></p>
          </div>
        </div>
      </div>
      <hr>
      <div class="text-center">
        @if($roleAdmin)
        <p><a class="delete" href="#"> Delete Account </a></p>
        @endif
      </div>
    @endif

  </article>

@endsection