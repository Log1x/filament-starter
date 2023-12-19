<div>
  <a
    href="{{ route('home') }}"
    class="text-sm text-blue-500 transition-colors hover:text-blue-600"
    wire:navigate
  >
    &larr; Back
  </a>

  <h1 class="mt-4 text-4xl">
    {{ $post->title }}
  </h1>

  <div class="mt-1 text-sm">
    Posted by {{ $post->user->name }} on {{ $post->published_at->format('F j, Y') }}
  </div>

  <div class="pt-6 mt-4 prose border-t">
    @foreach ($post->blocks as $block)
      @switch($block->type)
        @case('markdown')
          @markdom($block->data->content)
        @break

        @case('figure')
          <x-figure
            :image="$block->data->image"
            :alt="$block->data->alt"
            :caption="$block->data->caption"
          />
        @break

        @default
          @dump($block)
      @endswitch
    @endforeach
  </div>
</div>
