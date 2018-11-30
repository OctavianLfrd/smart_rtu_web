<!DOCTYPE html>
<html lang="ru">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
    @section("links")

    {{-- Vue.js --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <link rel="stylesheet" href="{{ asset('css/std_layout.css') }}">
    {{-- <!-- Latest compiled and minified CSS --> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    {{-- <!-- jQuery library --> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{-- <!-- Popper JS --> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    {{-- <!-- Latest compiled JavaScript --> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


    {{-- Google Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @show
</head>
<body>

                                    {{-- Расположение --}}
    @include('layouts.header')
    <main role="main" class="container" v-cloak>
        @yield('content')
    </main>
    @section("scripts")

    @show
    @include('layouts.footer')
</body>
</html>
