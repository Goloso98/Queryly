@extends('layouts.app')

@section('title', $user->name)

@section('content')

<form method="post" action="{{ route('editUser', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <br>
    <div>
        <h2 class="text-center">Edit your profile</h2>
        <br>
        <div class="input-group mb-3">
            <span class="input-group-text">Name</span>
            <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name"  value="{{ $user->name }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Username</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username"  value="{{ $user->username }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Email</span>
            <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email"  value="{{ $user->email }}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
            <span class="input-group-text">Confirm Password</span>
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password_confirmation">
        </div>
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        <br>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <div class="text-center">
            <input type="submit" value="Save Changes">
            <p><a href="#" onclick="history.back()">Cancel</a></p>
        </div>
        <br>
    </div>
</form>
@endsection