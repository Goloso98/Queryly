@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('recoverpasswordForm') }}">
    {{ csrf_field() }}
    <br>
    <h2 class="centering">Enter your email:</h2>
    @if ($errors->has('email'))
      <span class="error">
        {{ $errors->first('email') }}
      </span>
    @endif
    <div class="input-group mb-3">
        <span class="input-group-text">Email</span>
        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email">
    </div>

    <div class="buttons">
        <p></p> <!-- br does not work -->
        <button type="submit" class="btn outlined">Send Email</button>
        <p></p> <!-- br does not work -->
        <p><a href="{{ route('login') }}" class="btn">Cancel</a></p>
    </div>

</form>
<p></p>
@endsection