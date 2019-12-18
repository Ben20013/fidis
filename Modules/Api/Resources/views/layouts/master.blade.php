<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Fidis-api-doc</title>

       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="{{ asset('css/api.css') }}">

    </head>
    <style>
    html,body{
        height: 100%;
        width: 100%;
    }
    </style>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        <script src="{{ asset('js/api.js') }}"></script>
    </body>
</html>
