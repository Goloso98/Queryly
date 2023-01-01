<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/newbs.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/32cf153bee.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="bg-primary position-sticky">
        <div class="container">
            @include('partials.navbar')
        </div>
    </div>
    <div class="row">
        <div class="col-3 d-none d-sm-block">
            <br>
            <div class="menu">
                <h3 class="centering">Menu</h3>
                <hr>
                <a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('homepage') }}">Browse</a>
                <a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('posts.top') }}">Top Questions</a>
                <a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('users.page') }}">Users</a>
                <a class="menu__item" type="button" class="btn btn-outline-dark" href="{{ route('tags.page') }}">Tags</a>
            </div>
        </div>
        <div class="col-sm-7 col-12 mx-3 mx-sm-0">
            @yield('content')
        </div>
    </div>
    <button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>
    <div class="bg-info mt-auto">
        <div class="container">
            @include('partials.footer')
        </div>
    </div>

</body>
<!-- v3 -->
</html>
