<?php

namespace App\Http\Resources;

use App\Services\Util\HashIdService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (new HashIdService())->encode($this->id),
            'name' => $this->name,
            'mime_type' => $this->mime_type,
            'file_name' => $this->file_name,
            'original_url' => $this->original_url,
            'custom_properties' => $this->custom_properties,
        ];
    }
}
