<div>
  <x-hero title="Home" />

  <x-container>
    <h2 class="mb-6 text-4xl">
      Latest Posts
    </h2>

    <ul class="ml-4 space-y-1 list-disc">
      @foreach ($posts as $post)
        <li>
          <a
            class="text-primary-500 transition-colors hover:text-primary-600"
            href="{{ $post->url }}"
            wire:navigate
          >
            {{ $post->title }}
          </a>
        </li>
      @endforeach

      @empty($posts)
        <li class="text-gray-500">
          No posts yet.
        </li>
      @endempty
    </ul>

    @if ($posts->hasPages())
      <div class="pt-6 mt-6 border-t">
        {{ $posts->links() }}
      </div>
    @endif
  </x-container>
</div>
