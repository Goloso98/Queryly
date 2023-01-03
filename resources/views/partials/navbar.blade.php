<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="{{ route('homepage')}}" class="navbar-brand">
            <img src="{{ URL::asset('logo.png') }}" alt="{{ config('app.name', 'Laravel') }}!"
                 style="width:42px;height:42px;">
        </a>
        <button class="navbar-toggler position-relative" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span id="notificationCounter2" class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle d-none"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end centering" id="navbarSupportedContent">
            <ul class="navbar-nav gap-2 mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/posts/questions/new">Post Question</a>
                </li>

                <!-- --- mobile sub menu -->
                <li class="nav-item d-sm-none">
                    <a class="btn btn-outline-light" aria-current="page" href="{{ route('homepage') }}">Browse</a>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="btn btn-outline-light" aria-current="page" href="{{ route('posts.top') }}">Top Questions</a>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="btn btn-outline-light" aria-current="page" href="{{ route('users.page') }}">Users</a>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="btn btn-outline-light" aria-current="page" href="{{ route('tags.page') }}">Tags</a>
                </li>
                <!-- --- mobile sub menu end -->

                @if (Auth::check())
                <li class="nav-item">
                    <a class="btn btn-outline-light" aria-current="page" href="/logout">Logout</a>
                </li>
                <li class="nav-item">
                    <button id="notificationButton" type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#notificationsOffcanvas">
                        <i class="fa-solid fa-bell position-relative mx-1">
                            <span id="notificationCounter" class="position-absolute top-0 start-100 badge rounded-pill bg-danger"></span>
                        </i>
                        <p class="p-0 m-0 pushright invisible">100</p> <!-- button padding for badge -->
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link userBtn" aria-current="page"
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
