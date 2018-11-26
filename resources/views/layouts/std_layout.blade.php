<!DOCTYPE html>
<html lang="ru">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
    @section("links")
    <link rel="stylesheet" href="css/std_layout.css">
        {{-- Vue.js --}}<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        {{-- Popper.js --}}<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
        {{-- jQuery --}}<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        {{-- CSS Bootstrap --}}<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        {{-- JS Bootstrap --}}<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        {{-- JS Bundle --}}<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
        {{-- Google Material Icons --}}<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
