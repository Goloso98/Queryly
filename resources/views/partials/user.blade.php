<article class="userbuttons" data-id="{{ $user->id }}">
  <header>
    <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
    <p>&#64;{{ $user->username }}</p>
    <p>e-mail: {{ $user->email }}</p>
  </header>

  <a class="btn" aria-current="page" href="#"> See Followed Tags </a>
  <a class="btn" aria-current="page" href="#"> My Badges </a>
  <a class="btn" aria-current="page" href="{{ route('editUser', $user->id) }}"> Edit </a>
  <a class="delete" href="#"> Delete My Account </a>

  <div style="width:10px; height:30px; float:left;"></div>

  <div style="width:250px; height:30px; float:left;">
    <a class="btn" aria-current="page" href="{{ route('users.questions', $user->id) }}"> My questions </a>
  </div>

  <div style="width:10px; height:30px; float:left;"></div>

  <div style="width:250px; height:30px; float:left;">
    <a class="btn" aria-current="page" href="{{ route('users.answers', $user->id) }}"> My answers </a>
  </div>
</article>


