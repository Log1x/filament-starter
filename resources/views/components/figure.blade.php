@props(['image', 'alt', 'caption'])

<figure>
  <img
    class="object-cover w-full border rounded-lg shadow"
    src="{{ Awcodes\Curator\Models\Media::find($image)?->url ?? $image }}"
    alt="{{ $alt }}"
  >

  @if ($caption)
    <figcaption class="text-sm text-gray-500">
      {{ $caption }}
    </figcaption>
  @endif
</figure>
