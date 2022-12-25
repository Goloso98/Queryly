<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>

            <ul class="menu__box">
                <li><a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('homepage') }}">Browse</a></li>
                <li><a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('posts.top') }}">Top Questions</a></li>
                <li><a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('users.page') }}">Users</a></li>
                <li><a class="menu__item" type="button" class="btn btn-outline-dark" href="#">Tags</a></li>
            </ul>
        </div>
        <a href="{{ route('homepage')}}" class="navbar-brand">
            <img src="{{ URL::asset('logo.png') }}" alt="{{ config('app.name', 'Laravel') }}!"
                 style="width:42px;height:42px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav gap-2 mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/posts/questions/new">Post Question</a>
                </li>

                @if (Auth::check())
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/logout">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"
                       href="/users/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/login">Login</a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
