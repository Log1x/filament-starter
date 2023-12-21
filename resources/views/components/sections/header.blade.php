<header class="text-white bg-black shadow">
  <x-container>
    <nav class="flex items-center justify-between py-4">
      <a
        wire:navigate
        href="/"
        class="flex items-center flex-shrink-0 mr-auto"
        aria-label="{{ config('app.name') }}"
      >
        <x-logo />
      </a>

      <div>
        <a
          wire:navigate
          href="{{ route('home') }}"
          class="px-4 py-2 text-sm transition-colors hover:text-primary-500"
        >
          Home
        </a>

        @if (Auth::check())
          <x-button
            class="ml-4"
            icon="heroicon-o-cog"
            size="xs"
            url="/admin"
          >
            Manage
          </x-button>
        @endif
      </div>
    </nav>
  </x-container>
</header>
