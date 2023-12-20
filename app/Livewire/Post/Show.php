<?php

namespace App\Livewire\Post;

use App\Concerns\HasPreview;
use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
    use HasPreview;

    /**
     * The post instance.
     *
     * @var \App\Models\Post
     */
    public $post;

    /**
     * Mount the component.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function mount($post)
    {
        $this->post = Post::published()
            ->whereSlug($post)
            ->firstOrFail();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->handlePreview();

        seo()
            ->title($this->post->title)
            ->description($this->post->excerpt)
            ->canonical($this->post->url);

        return view('livewire.post.show');
    }
}
