<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
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
        seo()
            ->title($this->post->title)
            ->description($this->post->excerpt)
            ->canonical($this->post->url);

        return view('livewire.post.show');
    }
}
