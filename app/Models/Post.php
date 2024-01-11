<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'source',
        'imported',
    ];

    /**
     * Scope a query to only include root comments.
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
}
