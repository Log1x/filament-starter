<div>
  <h1 class="text-4xl mb-6">
    Latest Posts
  </h1>

  <ul class="list-disc ml-4 space-y-1">
    @foreach ($posts as $post)
      <li>
        <a
          class="text-blue-500 hover:text-blue-600 transition-colors"
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
    <div class="mt-6 pt-6 border-t">
      {{ $posts->links() }}
    </div>
  @endif
</div>
