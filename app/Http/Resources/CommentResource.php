<?php

namespace App\Http\Resources;

use App\Services\Util\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (new HashIdService())->encode(($this->id)),
            'isAuthor' => auth()->user() ? auth()->user()->is($this->user) : null,
            'author' => $this->user->only(['first_name', 'last_name', 'username', 'avatar']),
            'post_id' => (new HashIdService())->encode(($this->post_id)),
            'parent_id' => $this->comment_id ? (new HashIdService())->encode(($this->comment_id)) : null,
            'message' => $this->message,
            'replies' => $this->collection($this->replies),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
