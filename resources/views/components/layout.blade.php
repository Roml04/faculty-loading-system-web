@props(['pagetitle' => 'Untitled'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pagetitle }}</title>
        @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/css/media-queries.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full flex flex-col justify-between gap-8">
        {{ $slot }}
        @stack('scripts')
    </body>
</html>
