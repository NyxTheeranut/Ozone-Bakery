<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ozone Bakery</title>

    <!-- Set the favicon (icon) for your website -->
    <link rel="icon" href="https://icons.veryicon.com/png/o/food--drinks/sweet-dessert-icon/croissant-18.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if (auth()->user())
        @if (auth()->user()->is_admin == 1)
            @include('layouts.admin.navbar')
        @else
            @include('layouts.subviews.navbar')
        @endif
    @else
        @include('layouts.subviews.navbar')
    @endif
    <main class="bg-gray-100 min-h-screen">
        @yield('content')
    </main>
</body>

</html>