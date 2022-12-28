@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <br>
    <h2 class="centering">Welcome Back!</h2>
    <hr>
    <br>
    @if ($errors->has('email'))
      <span class="error">
        {{ $errors->first('email') }}
      </span>
    @endif
    <div class="input-group mb-3">
        <span class="input-group-text">Email</span>
        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email">
    </div>

    @if ($errors->has('password'))
      <span class="error">
        {{ $errors->first('password') }}
      </span>
    @endif
    <div class="input-group mb-3">
      <span class="input-group-text">Password</span>
      <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
    </div>

    <div class="buttons">
        <br>
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
        <p></p> <!-- br does not work -->
        <button type="submit" class="btn outlined">
            Login
        </button>
        <p></p> <!-- br does not work -->
        <a class="btn" href="{{ route('register') }}">Register</a>
    </div>

    @if (session('error'))
      <div class="alert alert-danger">
            {{ session('error') }}
      </div>
    @endif

</form>
<p></p>
@endsection
