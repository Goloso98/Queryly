@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <br>
    <h2 class="centering">Create Your Account!</h2>
    <hr>
    <br>
    @if ($errors->has('name'))
      <span class="error">
        {{ $errors->first('name') }}
      </span>
    @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Name</span>
        <input id="name" type="text" name="name" class="form-control" placeholder="Name">
    </div>
    @if ($errors->has('username'))
      <span class="error">
        {{ $errors->first('username') }}
      </span>
    @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Username</span>
      <input id="username" type="text" name="username" class="form-control" placeholder="Username">
    </div>
    @if ($errors->has('email'))
      <span class="error">
        {{ $errors->first('email') }}
      </span>
    @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Email</span>
        <input id="email" type="text" name="email" class="form-control" placeholder="Email">
    </div>
    @if ($errors->has('birthday'))
      <span class="error">
          {{ $errors->first('birthday') }}
      </span>
    @endif
    <div class="centering">
      <label for="birthday">Birthday</label>
      <input id="birthday" type="date" name="birthday">
      <p></p>
    </div>

    @if ($errors->has('password'))
      <span class="error">
        {{ $errors->first('password') }}
      </span>
    @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Password</span>
      <input id="password" type="password" name="password" class="form-control" placeholder="Password">

      <span class="input-group-text">Confirm Password</span>
      <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Password">
    </div>
    <ul class="info">
      <li id="password-min">Must be at least 6 characters in length</li>
      <li id="password-az">Must contain at least one lowercase letter</li>
      <li id="password-AZ">Must contain at least one uppercase letter</li>
      <li id="password-digit">Must contain at least one digit</li>
    </ul>
    <br>

    <div class="buttons">
      <button type="submit" class="btn outlined">
        Register
      </button>
      <a class="btn" href="{{ route('login') }}">Login</a>
    </div>
</form>
<p></p>
@endsection
