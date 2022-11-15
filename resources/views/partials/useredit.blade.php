<form method="post" action="{{ route('editUser', $user->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}

    <label>Name</label> <br>
    <input type="text" name="name"  value="{{ $user->name }}" />
    <p></p>
    <label>Username</label> <br>
    <input type="text" name="name"  value="{{ $user->username }}" />
    <p></p>
    <label>E-mail</label> <br>
    <input type="email" name="email"  value="{{ $user->email }}" />
    <p></p>
    <label>Password</label> <br>
    <input type="password" name="password" />
    <p></p>
    <label>Confirm Password</label> <br>
    <input type="password" name="password_confirmation" />
    <p></p>
    <a class="btn" aria-current="page" href="/users/{{ $user->id }}/edit"> Submit </a>
</form>