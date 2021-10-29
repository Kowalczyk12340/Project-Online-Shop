@props(['styles' => '', scripts => ''])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="author" content="Marcin Kowalczyk">
        <title>Bootstrap v5.0</title>
        {{-- Globalne style CSS --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- Lokalne style CSS --}}
        {{ $styles }}
    </head>
    <body>
        {{ $slot }}
    </body>
    {{-- Globalne skrypty JS --}}
    <script src={{ asset('js/app.js') }}></script>
    {{-- Lokalne skrypty JS --}}
    {{ $scripts }}
</html>