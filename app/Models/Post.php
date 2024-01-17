<?php

namespace App\Models;

use App\Casts\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelVote\Traits\Votable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Post extends Model implements HasMedia
{
    use HasFactory, Votable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'source',
        'imported',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'content' => PurifyHtmlOnGet::class,
    ];

    /**
     * Scope a query to only posts published.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where(['published' => true]);
    }

    /**
     * User posts
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
