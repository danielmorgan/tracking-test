<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>Tracking Test</title>

    <link href="https://api.mapbox.com/mapbox-gl-js/v0.33.1/mapbox-gl.css" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
</head>
<body>
    @yield('body')

    @stack('scripts')

    <link href="https://fonts.googleapis.com/css?family=Marko+One|Playfair+Display:400,700" rel="stylesheet">
</body>
</html>
