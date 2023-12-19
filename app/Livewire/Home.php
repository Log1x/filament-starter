<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        seo()
            ->title('Filament Starter')
            ->description('Lorem ipsum...');

        $posts = Post::published()
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.home', compact('posts'));
    }
}
