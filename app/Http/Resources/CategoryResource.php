<?php

namespace App\Http\Resources;

use App\Services\Util\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (new HashIdService)->encode($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'color' => $this->color,
            'image' => $this->image,
        ];
    }
}
