@inject('carbon', 'Carbon\Carbon')

<article class="user" data-id="{{ $user->id }}" user-id="{{ Auth::id() }}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <p>
                        <a href="{{route('users.profile', $user->id)}}" class="btn" id="cardBtn">See User</a>
                    </p>
                    <p class="card-text">&#64;{{ $user->username }}</p>
                    <p class="card-text">Email: {{$user->email}}</p>
                    <p class="card-text">Age: {{ $carbon::parse($user->birthday)->diff($carbon::now())->y }}</p>
                </div>
                <div class="col-12 col-sm-4">
                    <img src="{{ $user->avatar }}" class="rounded img-fluid" alt="Profile Pictture">
                </div>
            </div>
        </div>
    </div>
</article>
<br>