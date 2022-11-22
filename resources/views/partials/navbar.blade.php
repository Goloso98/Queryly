<nav class="navbar navbar-expand-sm navbar-dark bg-primary p-3 mb-3">
    <div class="acontainer-fluid">
        <a href="{{ route('homepage')}}" class="navbar-brand">
            <img src="{{ URL::asset('logo.png') }}" alt="{{ config('app.name', 'Laravel') }}!" style="width:42px;height:42px;">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/posts/questions/new">Post Question</a>
                </li>
            </ul>
        @if (Auth::check())
            <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/logout">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/users/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a>
                </li>
            </ul>
        @else
            <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/login">Login</a>
                </li>
            </ul>
        @endif
    </div>
</nav>
