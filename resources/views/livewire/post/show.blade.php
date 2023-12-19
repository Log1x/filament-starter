<div>
  <a
    href="{{ route('home') }}"
    class="text-sm text-blue-500 hover:text-blue-600 transition-colors"
    wire:navigate
  >
    &larr; Back
  </a>

  <h1 class="text-4xl mt-4">
    {{ $post->title }}
  </h1>

  <div class="text-sm mt-1">
    Posted by {{ $post->user->name }} on {{ $post->published_at->format('F j, Y') }}
  </div>

  <div class="prose mt-4 pt-6 border-t">
    @foreach ($post->blocks as $block)
      @switch($block->type)
        @case('markdown')
          {!! Str::markdown($block->data->content) !!}
        @break

        @case('figure')
          <figure>
            <img
              class="rounded-lg border shadow object-cover w-full"
              src="{{ url($block->data->image) }}"
              alt="{{ $block->data->alt }}"
            >

            @if ($block->data->caption)
              <figcaption class="text-sm text-gray-500">
                {{ $block->data->caption }}
              </figcaption>
            @endif
          </figure>
        @break

        @default
          @dump($block)
      @endswitch
    @endforeach
  </div>
</div>
