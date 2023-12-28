<?php

namespace App\Console\Commands;

use Exception;
use Filament\Facades\Filament;
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
     */
    protected array $sitemaps = [];

    /**
     * The chunk count.
     */
    protected int $chunks = 0;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->chunks = $this->option('chunk');

        $this->components->info('Generating sitemaps');

        $this
            ->generateResourceSitemaps()
            ->generateSitemapIndex();

        $this->components->info('Sitemaps generated successfully');
    }

    /**
     * Generate the sitemap index.
     */
    protected function generateSitemapIndex(): self
    {
        $count = count($this->sitemaps);

        if ($count === 0) {
            $this->components->warn('No sitemaps found');

            return $this;
        }

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
     * Generate the resource sitemaps.
     */
    protected function generateResourceSitemaps(): self
    {
        $resources = collect(Filament::getPanels())
            ->flatMap(fn ($panel) => $panel->getResources())
            ->map(fn ($resource) => $resource::getModel())
            ->filter(fn ($model) => $model::make()->sitemap)
            ->unique();

        if ($resources->isEmpty()) {
            $this->components->warn('No resources found with sitemap enabled');

            return $this;
        }

        $resources->each(function ($model) {
            $model::chunk($this->chunks, function ($records, $page) {
                $key = $records->first()->getTable();
                $key = $page === 1 ? $key : "{$key}-{$page}";
                $count = count($records);

                $this->components->task("Generating sitemap <fg=blue>{$key}-sitemap.xml.gz</> with <fg=blue>{$count}</> items", function () use ($records, $key) {
                    $sitemap = Sitemap::create($key);

                    foreach ($records as $record) {
                        if (! $record->url) {
                            throw new Exception("A URL attribute must be defined on the {$record->getTable()} model.");
                        }

                        $url = Url::create($record->url)
                            ->setLastModificationDate($record->updated_at)
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
