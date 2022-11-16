<header>
  <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
  <p>&#64;{{ $user->username }}</p>
  <p>e-mail: {{ $user->email }}</p>
</header>

<div style="width:200px; float:left;">
  <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
      <li class="nav-item">
        <a class="btn" aria-current="page" href="#"> See Followed Tags </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="#"> My Badges </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="#"> Delete Account </a>
      </li>
  </ul>
</div>

<div style="width:10px; height:300px; float:left;"></div>

<div style="width:250px; height:300px; float:left;">
  <a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> My questions </a>
</div>

<div style="width:10px; height:300px; float:left;"></div>

<div style="width:250px; height:300px; float:left;">
  <a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> My answers </a>
</div>


