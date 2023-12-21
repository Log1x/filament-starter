@unless ($breadcrumbs->isEmpty())
  <nav>
    <ol class="flex flex-wrap py-4 text-sm">
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && ! $loop->last)
          <li>
            <a
              wire:navigate
              href="{{ $breadcrumb->url }}"
              class="text-white transition-colors hover:text-primary-500 focus:text-primary-500"
            >
              {{ $breadcrumb->title }}
            </a>
          </li>
        @else
          <li class="{{ ! $loop->last ? 'text-white' : 'text-primary-500' }}">
            {{ $breadcrumb->title }}
          </li>
        @endif

        @unless ($loop->last)
          <li class="px-2 text-gray-500">
            <x-heroicon-m-chevron-right class="w-5 h-5 text-primary-500" />
          </li>
        @endif
      @endforeach
    </ol>
  </nav>
@endunless
