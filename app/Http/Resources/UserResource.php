<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'cover' => $this->cover,
            'avatar' => $this->avatar,
            'followings_count' => $this->followings()->count(),
            'followers_count' => $this->followers()->count(),
            "has_followed" => auth()->check() ? $this->isFollowedBy(auth()->user()) : null,
        ];
    }
}
