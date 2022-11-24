@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <p></p>
    <h2 class="text-center">Create Your Account!</h2>
    <p></p>
    <div class="input-group mb-3">
      <span class="input-group-text">Name</span>
      <div class="form-floating">
        <input id="name" type="text" name="name" class="form-control" placeholder="Username">
        @if ($errors->has('name'))
          <span class="error">
            {{ $errors->first('name') }}
          </span>
        @endif
      </div>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">Username</span>
      <div class="form-floating">
        <input id="username" type="text" name="username" class="form-control" placeholder="Username">
        @if ($errors->has('username'))
          <span class="error">
            {{ $errors->first('username') }}
          </span>
        @endif
      </div>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">Email</span>
      <div class="form-floating">
        <input id="email" type="text" name="email" class="form-control" placeholder="Email">
        @if ($errors->has('email'))
          <span class="error">
            {{ $errors->first('email') }}
          </span>
        @endif
      </div>
    </div>

    <div class="text-center">
      <label for="birthday">Birthday</label>
      <input id="birthday" type="date" name="birthday" required autofocus>
      @if ($errors->has('birthday'))
        <span class="error">
            {{ $errors->first('birthday') }}
        </span>
      @endif
      <p></p>
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Password</span>
      <div class="form-floating">
        <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
        @if ($errors->has('password'))
          <span class="error">
            {{ $errors->first('password') }}
          </span>
        @endif
      </div>

      <span class="input-group-text">Confirm Password</span>
      <div class="form-floating">
        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Password" required>
      </div>
    </div>

    <div class="text-center">
      <button type="submit">
        Register
      </button>
      <p></p>
      <a class="button button-outline" href="{{ route('login') }}">Login</a>
    </div>
</form>
<p></p>
@endsection
