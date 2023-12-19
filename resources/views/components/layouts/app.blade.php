<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Filament Starter' }}</title>

    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="text-base leading-normal tracking-normal text-gray-800 transition-colors">
    <div>
      {{ $slot }}
    </div>

    @stack('scripts')
  </body>
</html>
