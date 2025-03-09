@props(['pagetitle' => 'Untitled'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $pagetitle }}</title>

        @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col justify-between gap-8">
        {{ $slot }}
    </body>
</html>
