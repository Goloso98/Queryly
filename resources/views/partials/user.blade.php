<header>
  <h2><a href="/users/{{ $user->id }}">{{ $user->name }}</a></h2>
  <p>{{ $user->username }} {{ $user->email }}</p>
</header>

<span><a class="button" href="{{ url('/logout') }}"> See Followed Tags </a></span>
<span><a class="button" href="{{ url('/logout') }}"> My Badges </a></span>
<span><a class="button" href="{{ url('/logout') }}"> Edit </a></span>
<span><a class="button" href="{{ url('/logout') }}"> Delete Account </a></span>