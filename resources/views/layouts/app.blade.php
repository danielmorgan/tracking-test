<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tracking Test</title>

    <link href="https://api.mapbox.com/mapbox-gl-js/v0.33.1/mapbox-gl.css" rel="stylesheet" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
</head>
<body>
@yield('body')

@stack('scripts')
</body>
</html>