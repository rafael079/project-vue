<?php

namespace App\Models;

use App\Casts\HashId;
use App\Services\Util\HashIdService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'community_id',
        'category_id',
        'name',
        'slug',
        'image',
        'color',
        'description'
    ];

    /**
     * Scope a query to only root categories.
     */
    public function scopeRoot(Builder $query): void
    {
        $query->where(['root' => true]);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

}
