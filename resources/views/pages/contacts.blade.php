@extends('layouts.app')

@section('content')
  <head>
    <title>Contact Us</title>
  </head>
  <body>
    <h1>Contact Us</h1>
    <p>Thank you for considering reaching out to us. We are here to help and answer any questions you may have. Please don't hesitate to contact us.</p>
    <h2>Contact Information</h2>
    <ul>
      <li>Phone: 9199pfñmeencomode</li>
      <li>Email: albertojoaquim420@gmail.com</li>
      <li>Address: Rua das Flores 69</li>
    </ul>
    <h2>Send Us a Message</h2>
    <form method="POST">
      @csrf 
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name"><br>
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email"><br>
      <label for="message">Message:</label><br>
      <textarea id="message" name="message"></textarea><br>
      <input type="submit" value="Submit">
    </form> 
  </body>
@endsection