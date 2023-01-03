@inject('carbon', 'Carbon\Carbon')

@extends('layouts.app')

@section('title', $user->name)

@section('content')
  <article class="userbuttons" data-id="{{ $user->id }}">
    @php
      $roles = $user->roles;
      $roleAdmin = $roles->contains(function($item){
          return $item->userrole === 'Administrator';
        });
      $roleMod = $roles->contains(function($item){
          return $item->userrole === 'Moderator';
        });
      $roleText = '(';
      if($roleAdmin) $roleText = $roleText.'Administrator';
      if($roleAdmin && $roleMod) $roleText = $roleText.', ';
      if($roleMod) $roleText = $roleText.'Moderator';
      $roleText = $roleText.')';
      $authroles = Auth::user()->roles;
      $authAdmin = $authroles->contains(function($item){
        return $item->userrole === 'Administrator';
      });
      $authMod = $authroles->contains(function($item){
        return $item->userrole === 'Administrator';
      });
    @endphp
    <br>

    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
    
    @include('partials.user', ['profile' => TRUE])
    <br>

    @if(Auth::check() && Auth::user() == $user)
      <div class="container centering">
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
        @if($authAdmin || $authMod)
          <hr>
          @if($authAdmin)
            <p><a class="btn" aria-current="page" href="{{ route('admin.messages') }}">Messages</a></p>
            <p><a class="btn" aria-current="page" href="{{ route('admin.blocked') }}">See Blocked Users</a></p>
          @endif
          @if($authMod)
            <p><a class="btn" aria-current="page" href="{{ route('users.manageReports', $user->id) }}"> Manage Reports </a></p>
          @endif
        @endif
        <hr>
        <p><a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a></p>
        <form method="post" action="{{ route('users.delete', $user->id) }}">
          @csrf
          <button type="submit" class="btn">  Delete My Account </button>
        </form>
      </div>
    @else
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
        <hr>
        @if($authAdmin && $user->id != Auth::id())
          <form method="post" action="{{ route('users.block', $user->id) }}">
            @csrf
            @method('PATCH')
            <p>
              <button type="submit" class="btn outlined">
                @if($user->isblocked)
                  Unblock Account
                @else
                  Block Account
                @endif
              </button>
            </p>
          </form>
        @endif
        @can('update', $user) 
          <p><a class="btn cardBtn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a></p>
        @endcan
        <form method="post" action="{{ route('users.delete', $user->id) }}">
          @csrf
          <button type="submit" class="btn cardBtn">  Delete Account </button>
        </form>
      </div>
    @endif
    <br>
  </article>
@endsection