<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class PostOverview extends BaseWidget
{
    /**
     * The widget stats.
     */
    protected function getStats(): array
    {
        $posts = Post::count();
        $published = Post::published()->count();
        $drafts = Post::drafts()->count();

        return [
            Stat::make('Total Posts', Number::format($posts))
                ->description('The total number of posts')
                ->icon('heroicon-o-book-open'),

            Stat::make('Published Posts', Number::format($published))
                ->description('The total number of published posts')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Draft Posts', Number::format($drafts))
                ->description('The total number of draft posts')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
