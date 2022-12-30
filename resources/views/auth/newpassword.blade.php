@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('newpasswordForm', ['email' => $email]) }}">
    {{ csrf_field() }}
    <br>
    <h2 class="centering">Change your password:</h2>
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

    <div class="info">
      <li id="password-min">Must be at least 6 characters in length</li>
      <li id="password-az">Must contain at least one lowercase letter</li>
      <li id="password-AZ">Must contain at least one uppercase letter</li>
      <li id="password-digit">Must contain at least one digit</li>
    </div>

    <div class="buttons">
        <p></p> <!-- br does not work -->
        <button type="submit" class="btn outlined"> Change Password </button>
        <p></p> <!-- br does not work -->
        <p><a href="{{ route('login') }}" class="btn"> Cancel </a></p>
    </div>

</form>
<p></p>
@endsection