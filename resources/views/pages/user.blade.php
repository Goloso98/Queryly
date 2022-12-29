@inject('carbon', 'Carbon\Carbon')

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
      if($roleAdmin && $roleMod) $roleText = $roleText.', ';
      if($roleMod) $roleText = $roleText.'Moderator';
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

    <div class="row">

      <div class="col-8">
        <header>
          <h2>{{ $user->name }}</h2>
          @if(($roleAdmin || $roleMod) && Auth::user() == $user)
            <p class="role">{{ $roleText }}</p>
          @endif
        </header>
        <p>&#64;{{ $user->username }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Age: {{ $carbon::parse($user->birthday)->diff($carbon::now())->y }}</p>
        @if($user->isblocked)
          <span class="report small">This account is blocked.</span>
        @endif
      </div>

      <div class="col-12 col-sm-4">
        <img src="{{ $user->avatar }}" class="rounded img-fluid" alt="Profile Pictture">
      </div>

    </div>

    <hr>
    <div class="container centering">
        <div class="row">
          <div class="col">
            <p><a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> See questions </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> See answers </a></p>
          </div>
          <div class="col">
            <p><a class="btn" aria-current="page" href="{{ route('users.tags', $user->id) }}"> See Followed Tags </a></p>
            <p><a class="btn" aria-current="page" href="{{ route('users.badges', $user->id) }}"> See Badges </a></p>
          </div>
        </div>
    </div>
    <hr>

    <div class="centering">
      @can('update', $user) 
        <p><a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a></p>
      @endcan
      @can('delete', $user)
        <p><a class="delete btn" href="#"> Delete Account </a></p>
      @endcan
    </div>

    <hr>
    <div class="buttons">
      @if($roleAdmin)
        <form method="post" action="{{ route('users.block', $user->id) }}">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn outlined">
            @if($user->isblocked)
              Unblock Account
            @else
              Block Account
            @endif
          </button>
        </form>
        <br>
      @endif
    </div>
  </article>
<br>
@endsection