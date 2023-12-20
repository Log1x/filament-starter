<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait HasPreview
{
    /**
     * The preview token.
     */
    protected ?string $previewToken = null;

    /**
     * The preview status.
     */
    public bool $isPreview = false;

    /**
     * Handle the preview.
     */
    protected function handlePreview(?string $resource = null, string $token = 'previewToken'): void
    {
        if (! request()->has($token)) {
            return;
        }

        if (empty($resource) && ! empty($this->__name)) {
            $resource = Str::before($this->__name, '.');
        }

        $resource = Str::afterLast($resource, '\\');
        $resource = Str::slug($resource, '_');

        $attributes = session()->get('preview-'.request()->get($token));

        if (empty($attributes)) {
            return;
        }

        $this->isPreview = true;

        foreach ($attributes as $key => $value) {
            $this->{$resource}->{$key} = $value;
        }
    }

    /**
     * Generate a preview token and session.
     */
    protected function generatePreviewSession(string $record = 'record'): void
    {
        if (empty($resource = $this->previewModalData[$record])) {
            return;
        }

        $this->previewToken = uniqid();

        session()->put("preview-{$this->previewToken}", $resource->toArray());
    }
}
