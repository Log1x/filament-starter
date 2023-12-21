<div>
  <div class="hidden bg-black md:block bg-opacity-90">
    <x-container>
      {{ Breadcrumbs::render('post', $post) }}
    </x-container>
  </div>

  <article>
    <x-hero :title="$post->title">
      @slot('afterTitle')
        <div>Posted by {{ $post->user->name }}</div>

        <div
          class="inline-flex items-center text-xs cursor-help"
          x-tooltip.raw="{{ $post->published_at->format('F j, Y') }}"
        >
          <x-heroicon-o-calendar class="w-3 h-3 mr-1" />

          <time datetime="{{ $post->published_at->format('Y-m-d H:i:s') }}">
            {{ $post->published_at->diffForHumans() }}
          </time>
        </div>
      @endslot
    </x-hero>

    <x-container>
      <div class="prose max-w-none">
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

      @if (Auth::check())
        <div class="pt-4 mt-4 border-t">
          <a class="inline-flex items-center text-sm text-primary-500 hover:text-primary-600" href="{{ $post->editUrl }}">
            <x-heroicon-s-pencil class="inline-block w-3 h-3 mr-2" />
            Edit post
          </a>
        </div>
      @endif
    </x-container>
  </article>
</div>
