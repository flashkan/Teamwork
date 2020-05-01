<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/dc1b6a368a.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="d-flex flex-column justify-content-between">

    <div class="wrapper">
        @include('layouts.menu')
        <div class="p-4"></div>

        <main class="py-4">
            @if(session('success') || session('failure'))
                <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }}  alert-dismissible fade
                show container fixed-top mt-5" role="alert" style="opacity: 0.7">
                    {{ session('success') ?: session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="footer bg-secondary">
        <div class="container d-flex justify-content-around p-3 text-light">
            <div class="d-flex flex-column">
                <h5>About</h5>
                <a href="#" class="text-light my-1">About us</a>
                <a href="#" class="text-light my-1">Timeline</a>
                <a href="#" class="text-light my-1">Careers</a>
                <a href="#" class="text-light my-1">Corporate Sales</a>
            </div>
            <div class="d-flex flex-column">
                <h5>Support</h5>
                <a href="#" class="text-light my-1">Contact Us</a>
                <a href="#" class="text-light my-1">Returns</a>
                <a href="#" class="text-light my-1">Warranty</a>
                <a href="#" class="text-light my-1">Help / Shipping</a>
            </div>
            <div class="d-flex flex-column">
                <h5>Legal</h5>
                <a href="#" class="text-light my-1">Privacy</a>
                <a href="#" class="text-light my-1">Terms</a>
                <a href="#" class="text-light my-1">Patents</a>
                <a href="#" class="text-light my-1">Web Accessibility</a>
            </div>
            <div class="d-flex flex-column">
                <h5>Other</h5>
                <a href="#" class="text-light">Blog</a>
                <a href="#" class="text-light">Affiliate Program</a>
            </div>
            <div class="social d-flex align-items-center flex-column text-light">
                <div class="d-flex align-items-start">
                    <a href="#" class="m-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="m-2"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="d-flex">
                    <a href="#" class="m-2"><i class="fab fa-vk"></i></a>
                    <a href="#" class="m-2"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
