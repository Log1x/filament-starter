<?php

namespace App\Livewire\Post;

use App\Concerns\HasPreview;
use App\Models\Post;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

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
        $this->post = Post::whereSlug($post)->firstOrFail();

        $this->handlePreview();

        abort_unless($this->isPreview || $this->post->is_published, 404);
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
            ->canonical($this->post->url)
            ->addSchema(
                Schema::article()
                    ->headline($this->post->title)
                    ->articleBody($this->post->excerpt)
                    ->image($this->post->image?->url)
                    ->datePublished($this->post->published_at)
                    ->dateModified($this->post->updated_at)
                    ->author(Schema::person()->name($this->post->user->name))
            );

        if ($this->post->image) {
            seo()->image($this->post->image->url);
        }

        return view('livewire.post.show');
    }
}
