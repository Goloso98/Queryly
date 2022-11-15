<header>
  <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
  <p>&#64;{{ $user->username }}</p>
  <p>e-mail: {{ $user->email }}</p>
</header>

<div>
  <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
      <li class="nav-item">
        <a class="btn" aria-current="page" href="/logout"> See Followed Tags </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="/logout"> My Badges </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="/users/{{ $user->id }}/edit"> Edit </a>
      </li>
      <br>
      <li class="nav-item">
        <a class="btn" aria-current="page" href="/logout"> Delete Account </a>
      </li>
  </ul>
</div>


