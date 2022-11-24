<article class="userbuttons" data-id="{{ $user->id }}">
  @php
    $role = app\Http\Controllers\UserController::showRole();
  @endphp
  <p></p>
  <div>
    <div class="col">
      <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded float-end" style="width: 20%" alt="description of myimage">
    </div>
    <div class="col">
      <header>
        <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
        @if($role == 'Administrator' && Auth::user() == $user)
          <p>({{$role}})</p>
        @endif
      </header>
      <p>&#64;{{ $user->username }}</p>
      <p>e-mail: {{ $user->email }}</p>
      <p>Age: {{$age}}</p>
    </div>
  </div>
  <hr>

  @if(Auth::check() && Auth::user() == $user)
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <p><a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> My questions </a></p>
          <p><a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> My answers </a></p>
        </div>
        <div class="col">
          <p><a class="btn" aria-current="page" href="#"> See Followed Tags </a></p>
          <p><a class="btn" aria-current="page" href="#"> My Badges </a></p>
        </div>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p><a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a></p>
      <p><a class="delete" href="#"> Delete My Account </a></p>
    </div>
  @else
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <p><a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> See questions </a></p>
          <p><a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> See answers </a></p>
        </div>
        <div class="col">
          <p><a class="btn" aria-current="page" href="#"> See Followed Tags </a></p>
          <p><a class="btn" aria-current="page" href="#"> See Badges </a></p>
        </div>
      </div>
    </div>
    <hr>
    <div class="text-center">
      @if($role == 'Administrator')
      <p><a class="delete" href="#"> Delete Account </a></p>
      @endif
    </div>
  @endif


  <!-- @if (Auth::check() && Auth::user() == $user)
  <a class="delete" href="#"> Delete My Account </a>
  <a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a>
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
  @endif -->


</article>


