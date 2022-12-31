@extends('layouts.app')

@section('content')
  <br>
  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
  <br>
  <h2 class="centering">Contact Us</h2>
  <hr>
  <br>
  <p>Thank you for considering reaching out to us. We are here to help and answer any questions you may have. Please don't hesitate to contact us.</p>
  <br>
  <h3 class="centering">Contact Information</h3>
  <ul>
    <li>Phone: 9199pfñmeencomode</li>
    <li>Email: albertojoaquim420@gmail.com</li>
    <li>Address: Rua das Flores 69</li>
  </ul>
  <br>
  <div class="centering">
    <h3>Send Us a Message</h3>
    <br>
    <form method="POST">
      @csrf 
      <div class="input-group mb-3">
        <span class="input-group-text">Name</span>
        <input id="name" type="text" name="name" class="form-control" placeholder="Name">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Email</span>
        <input id="email" type="email" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="mb-3">
      <h5>Message:</h5>
      @if ($errors->has('commenttext'))
        <span class="error">
          {{ $errors->first('commenttext') }}
        </span>
      @endif
      <textarea name="message" id="message" class="form-control" rows="3" maxlength="250"></textarea>
      <div id="count-message">
        <span id="current-message">0</span>
        <span id="maximum-message">/ 250</span>
      </div>
      <br>
    </div>
      <div class="buttons">
        <input type="submit" value="Submit" class="btn outlined">
        <br>
      </div>
    </form> 
  </div>
@endsection