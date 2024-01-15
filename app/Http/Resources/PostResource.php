<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category ? $this->category->only(['id', 'name', 'slug', 'color']) : null,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'author' => $this->user->only(['first_name', 'last_name', 'avatar', 'username']),
            'total_votes' => $this->total_votes,
            'has_voted' => $this->has_voted,
            'has_upvoted' => $this->has_upvoted,
            'has_downvoted' => $this->has_downvoted,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
