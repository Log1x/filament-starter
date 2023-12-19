<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File as Storage;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate
                            {--chunk=1000 : The sitemap chunk size}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';

    /**
     * The sitemaps.
     *
     * @var array
     */
    protected $sitemaps = [];

    /**
     * The chunk count.
     *
     * @var int
     */
    protected $chunks;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', -1);

        $this->chunks = $this->option('chunk');

        $this->components->info('Generating sitemaps');

        $this
            ->generateStaticPageSitemaps()
            ->generatePostSitemaps()
            ->generateSitemapIndex();

        $this->newLine();
        $this->components->info('Sitemaps generated successfully');
    }

    /**
     * Generate the sitemap index.
     */
    protected function generateSitemapIndex(): self
    {
        $count = count($this->sitemaps);

        $this->components->task("Generating index <fg=blue>sitemap.xml</> with <fg=blue>{$count}</> items", function () {
            $index = SitemapIndex::create();

            foreach ($this->sitemaps as $key => $sitemap) {
                $timestamp = $sitemap->getTags()[0]->lastModificationDate ?? now();

                $index->add(
                    SitemapTag::create("/{$key}-sitemap.xml.gz")->setLastModificationDate($timestamp)
                );
            }

            $index->writeToFile(
                public_path('sitemap.xml')
            );
        });

        return $this;
    }

    /**
     * Generate the static page sitemaps.
     */
    protected function generateStaticPageSitemaps(): self
    {
        $this->components->task('Generating sitemap <fg=blue>page-sitemap.xml.gz</> with <fg=blue>static</> items', function () {
            $sitemap = Sitemap::create();

            $home = Url::create(
                route('home')
            )->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $sitemap->add($home);

            $this->sitemaps['page'] = $sitemap;

            $this->writeToGzip(
                public_path('page-sitemap.xml.gz'),
                $sitemap->render()
            );
        });

        return $this;
    }

    /**
     * Generate the post sitemaps.
     */
    protected function generatePostSitemaps(): self
    {
        Post::chunk($this->chunks, function ($posts, $page) {
            $key = $page === 1 ? 'post' : "post-{$page}";
            $count = count($posts);

            $this->components->task("Generating sitemap <fg=blue>{$key}-sitemap.xml.gz</> with <fg=blue>{$count}</> items", function () use ($posts, $key) {
                $sitemap = Sitemap::create($key);

                foreach ($posts as $post) {
                    $url = Url::create($post->url)
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.6);

                    $sitemap->add($url);
                }

                $this->writeToGzip(
                    public_path("{$key}-sitemap.xml.gz"),
                    $sitemap->render()
                );

                $this->sitemaps[$key] = $sitemap;
            });
        });

        return $this;
    }

    /**
     * Write the gzipped sitemap to file.
     */
    protected function writeToGzip(string $path, string $content): self
    {
        $gzipped = gzencode($content);

        Storage::ensureDirectoryExists(dirname($path));

        file_put_contents($path, $gzipped);

        return $this;
    }
}
