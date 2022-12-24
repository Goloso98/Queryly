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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/32cf153bee.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@latest/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
</head>
<body>
    <div class="bg-primary position-sticky">
        <div class="container">
            @include('partials.navbar')
        </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-1" style="width: 0%">
            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                <p></p>
                <a type="button" class="btn btn-outline-dark" href="{{ route('homepage') }}">Browse</a>
                <a type="button" class="btn btn-outline-dark" href="{{ route('posts.top') }}">Top Questions</a>
                <a type="button" class="btn btn-outline-dark" href="#">Users</a>
                <a type="button" class="btn btn-outline-dark" href="#">Tags</a>
            </div>
        </div>
        <div class="col" style="width: 0%>
            <div class="container">
                <!-- <x-breadcrumb /> -->
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        @yield('content')
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
      </div>
    </div>
<div class="bg-info">
    <div class="container">
        @include('partials.footer')
    </div>
</div>

</body>
<!-- v3 -->
</html>
