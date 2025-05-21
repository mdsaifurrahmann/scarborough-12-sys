<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/png" />

    @livewireStyles
    @include('layouts._partials.panel.styles')

    {{-- <link href="assets/css/semi-dark.css" rel="stylesheet" />
    <link href="assets/css/header-colors.css" rel="stylesheet" /> --}}

    <title>@yield('title')</title>

    @yield('styles')
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">


        @include('layouts._partials.panel.sidebar')

        @include('layouts._partials.panel.header')



        <div class="page-content-wrapper">

            <div class="page-content">

                @yield('content')

            </div>

        </div>


        @include('layouts._partials.panel.footer')

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

    </div>
    <!--end wrapper-->




    {{-- @livewireScripts --}}
    @include('layouts._partials.panel.scripts')


</body>

</html>
