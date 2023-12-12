<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') </title>
    <style>
        @stack('css')
    </style>
</head>



<header>
    @yield('header')
    <nav>
        <ul>
            @yield('nav')
        </ul>
    </nav>
    @yield('anmeldung')
</header>



<main>
    @yield('main')
</main>



<footer>
    <ul>
        @yield('footer')
    </ul>
</footer>


