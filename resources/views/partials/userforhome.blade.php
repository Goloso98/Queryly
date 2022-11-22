<article class="userbuttons" data-id="{{ $user->id }}">
  <header>
    <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
    <p>&#64;{{ $user->username }}</p>
    <p>e-mail: {{ $user->email }}</p>
  </header>
</article>
<p></p>