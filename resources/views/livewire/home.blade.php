<div>
  <x-hero title="Home" />

  <x-container>
    <h2 class="mb-8 text-4xl">
      Latest Posts
    </h2>

    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
      @foreach ($posts as $post)
        <div>
          <a
            class="*:transition group"
            href="{{ $post->url }}"
            wire:navigate
          >
            <div class="w-full h-48 mb-2 overflow-hidden border rounded-lg group-hover:brightness-90">
              @if ($post->image)
                <img
                  class="object-cover w-full h-full"
                  src="{{ $post->image->url }}"
                  alt="{{ $post->image->alt ?? $post->title }}"
                />
              @else
                <div class="flex items-center justify-center w-full h-full text-gray-400 bg-gray-200">
                  Article
                </div>
              @endif
            </div>

            <h3 class="text-lg text-gray-700 group-hover:text-primary-500">
              {{ $post->title }}
            </h3>
          </a>
        </div>
      @endforeach

      @empty($posts)
        <div>No posts yet.</div>
      @endempty
    </div>

    @if ($posts->hasPages())
      <div class="pt-6 mt-6 border-t">
        {{ $posts->links() }}
      </div>
    @endif
  </x-container>
</div>
