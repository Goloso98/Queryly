<article class="userbuttons" data-id="{{ $user->id }}">
  @php
    $role = app\Http\Controllers\UserController::showRole();
  @endphp
  <header>
    <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
    @if($role == 'Administrator' && Auth::user() == $user)
      <p>({{$role}})</p>
    @endif
    <p>&#64;{{ $user->username }}</p>
    <p>e-mail: {{ $user->email }}</p>
    <p>Age: {{$age}}</p>
  </header>

  <!-- <a class="btn" aria-current="page" href="#"> See Followed Tags </a> -->
  <!-- <a class="btn" aria-current="page" href="#"> My Badges </a> -->
  @if (Auth::check() && Auth::user() == $user)
  <a class="delete" href="#"> Delete My Account </a>
  <a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a>

    <div style="width:10px; height:30px; float:left;"></div>

    <div style="width:250px; height:30px; float:left;">
      <a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> My questions </a>
    </div>

    <div style="width:10px; height:30px; float:left;"></div>

    <div style="width:250px; height:30px; float:left;">
      <a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> My answers </a>
    </div>
  @else
    @if($role == 'Administrator')
    <a class="delete" href="#"> Delete Account </a>
    @endif
    <div style="width:250px; height:30px; float:left;">
      <a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> See questions </a>
    </div>

    <div style="width:10px; height:30px; float:left;"></div>

    <div style="width:250px; height:30px; float:left;">
      <a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> See answers </a>
    </div>
  @endif

</article>


