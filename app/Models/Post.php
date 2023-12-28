<?php

namespace App\Models;

use App\Filament\Resources\PostResource;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_id',
        'user_id',
        'is_published',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the user that owns the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the featured image for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Retrieve the post URL.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('post.show', $this);
    }

    /**
     * Retrieve the post edit URL.
     *
     * @return string
     */
    public function getEditUrlAttribute()
    {
        return PostResource::getUrl('edit', ['record' => $this]);
    }

    /**
     * Retrieve the post content blocks as an object.
     *
     * @return object
     */
    public function getBlocksAttribute()
    {
        return json_decode(
            collect($this->content ?? [])->toJson()
        );
    }

    /**
     * Retrieve the post excerpt.
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        $excerpt = collect($this->content)
            ->where('type', 'markdown')
            ->first() ?? [];

        $excerpt = collect(
            explode("\n", Arr::get($excerpt, 'data.content', ''))
        )->first();

        return Str::limit($excerpt, 160);
    }

    /**
     * Retrieve the published posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Retrieve the draft posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDrafts($query)
    {
        return $query->where('is_published', false);
    }
}
