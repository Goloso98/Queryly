@inject('carbon', 'Carbon\Carbon')

<article class="user" data-id="{{ $user->id }}">
    @php
      $roles = $user->roles;
      $roleAdmin = $roles->contains(function($item){
          return $item->userrole === 'Administrator';
        });
      $roleMod = $roles->contains(function($item){
          return $item->userrole === 'Moderator';
        });
      $roleText = '(';
      if($roleAdmin) $roleText = $roleText.'Administrator';
      if($roleAdmin && $roleMod) $roleText = $roleText.', ';
      if($roleMod) $roleText = $roleText.'Moderator';
      $roleText = $roleText.')';
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    @if($profile)
                        @if($roleAdmin || $roleMod)
                            <p class="role">{{ $roleText }}</p>
                        @endif
                    @else
                        <p>
                            <a href="{{route('users.profile', $user->id)}}" class="btn cardBtn">See User</a>
                        </p>
                    @endif
                    <p class="card-text">&#64;{{ $user->username }}</p>
                    <p class="card-text">Email: {{$user->email}}</p>
                    <p class="card-text">Age: {{ $carbon::parse($user->birthday)->diff($carbon::now())->y }}</p>
                    @if($profile && $user->isblocked)
                        <span class="report small">This account is blocked.</span>
                    @endif
                </div>
                <div class="col-12 col-sm-4">
                    <img src="{{ $user->avatar }}" class="rounded img-fluid" alt="Profile Picture">
                </div>
            </div>
        </div>
    </div>
</article>