@extends('layouts.app')

@section('title', $user->name)

@section('content')

<form method="post" action="{{ route('editUser', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <br>
    <div>
        <h2 class="text-center">Edit your profile</h2>
        <br>
        @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
        @endif
        <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name"  value="{{ $user->name }}">
        </div>
        @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
        @endif
        <div class="input-group mb-3">
            <span class="input-group-text">Username</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username"  value="{{ $user->username }}">
        </div>
        @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
        @endif
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email"  value="{{ $user->email }}">
        </div>
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif
        <div class="input-group" id="avatarDiv">
            <label for="avatar" class="input-group-text" id="avatarLabel">
                Select Profile Picture
            </label>
            <input type="file" class="form-control" id="avatar" name="avatar">
            &nbsp;&nbsp;
            <span id="avatarName" form-text></span>
        </div>
        <br>
        <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
            <span class="input-group-text">Confirm Password</span>
            <input id="password-confirm" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password_confirmation">
        </div>
        <div class="info">
            <li id="password-min">Must be at least 6 characters in length</li>
            <li id="password-az">Must contain at least one lowercase letter</li>
            <li id="password-AZ">Must contain at least one uppercase letter</li>
            <li id="password-digit">Must contain at least one digit</li>
        </div>
        <br>
        <div class="buttons">
            <input type="submit" class="btn outlined" value="Save Changes">
            <p><a href="{{route('users.profile', $user->id)}}" class="btn">Cancel</a></p>
        </div>
        <br>
    </div>
</form>
@endsection