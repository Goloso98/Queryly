<article class="user" data-id="{{ $user->id }}" user-id="{{ Auth::id() }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $user->name }}</h3>
            <p>
                <a href="{{route('users.profile', $user->id)}}">See User</a>
            </p>
            <p class="card-text">&#64;{{ $user->username }}</p>
            <p class="card-text">Email: {{$user->email}}</p>
        </div>
    </div>
</article>
<br>