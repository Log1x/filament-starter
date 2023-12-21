<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    {{ seo()->render() }}

    @stack('head')

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="text-base leading-normal tracking-normal text-gray-800">
    <x-sections.header />

    <div>
      {{ $slot }}
    </div>

    @livewireScriptConfig
    @stack('scripts')
  </body>
</html>
