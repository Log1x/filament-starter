@props(['size' => 'md'])

@php($size = match ($size) {
  'sm' => 'max-w-4xl',
  'md' => 'max-w-5xl',
  'lg' => 'max-w-6xl',
  default => 'max-w-4xl',
})

<div {{ $attributes->merge(['class' => "{$size} px-6 mx-auto"]) }}>
  {{ $slot }}
</div>
