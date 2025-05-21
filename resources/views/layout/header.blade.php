<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="{{ asset('/assets/image/logo.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/addition.css') }}">
    <link href="{{ asset('/assets/boxicons/css/boxicons.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('/assets/css/vanilla-dataTables.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/assets/css/vanilla-dataTables.min.js') }}" type="text/javascript"></script>
</head>

<body style="display: flex;flex-wrap: wrap;overflow-x: hidden;">
    <header>


        <div id="head">
            <img src="{{ asset('/assets/image/logo.png') }}" alt="" id="logo">
            <hr>

            @yield('nav-menu')

            <div id="toggle-menu">
                <input type="checkbox">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
        <a href="{{ route('logout') }}">
            <button class="btn">
                <i class="bx bx-log-out"></i>
                <span>Keluar</span>
            </button>
        </a>


    </header>
    <script>
        const toggleMenu = document.querySelector('#toggle-menu input');
        const nav = document.querySelector('nav');

        toggleMenu.addEventListener('click', function() {
            nav.classList.toggle('slide');
        });
    </script>