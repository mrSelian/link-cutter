<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} - {{ config('app.name', 'Link-Cutter') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <script src="https://yastatic.net/share2/share.js"></script>

</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
@include('layouts.navigation')
@if(Auth::user() != null )
    <!-- Page Heading -->
    {{--        <header class="bg-white shadow">--}}
    {{--            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
    {{--                {{ $header }}--}}
    {{--            </div>--}}
    {{--        </header>--}}
@endif
<!-- Page Content -->
    <main>
        @include('layouts.flash')
        {{ $slot }}
    </main>

</div>
<footer class="footer">
    <div class="footer_container container">
        <div class="row">
            <div class="footer_copyright col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">&copy; SouthCat, 2021</div>
            <div class="footer_menu mt-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <x-nav-link :href="route('dashboard')">
                    {{ __('menu-items.my_links') }}
                </x-nav-link>
                <br>
                <x-nav-link :href="route('create_link')">
                    {{ __('menu-items.cut_link') }}
                </x-nav-link>
                <br>
                <x-nav-link :href="route('qr_generator')">
                    {{ __('menu-items.qr_gen') }}
                </x-nav-link>
            </div>
            <div class="footer_about mt-3 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                @if(\Illuminate\Support\Facades\App::currentLocale() == 'ru')
                <x-nav-link :href="route('rules_page')">
                    {{ __('menu-items.rules') }}
                </x-nav-link>
                <br>
                @endif
                <x-nav-link :href="route('about_page')">
                    {{ __('menu-items.about') }}
                </x-nav-link>
                <br>
                <x-nav-link :href="route('donate_page')">
                    {{ __('menu-items.donate') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
