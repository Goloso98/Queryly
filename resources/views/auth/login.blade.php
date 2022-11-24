@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <p></p>
    <h2 class="text-center">Welcome Back!</h2>
    <p></p>
    <hr>
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
    </div>

    <div class="text-center">
        <p></p>
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
        <p></p>
        <button type="submit">
            Login
        </button>
        <p></p>
        <a class="button button-outline" href="{{ route('register') }}">Register</a>
    </div>
</form>
<p></p>
@endsection
