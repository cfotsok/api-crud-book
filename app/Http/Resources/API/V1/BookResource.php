<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'name' => $this->name,
            'resume' => $this->resume,
            'author' => $this->author,
            'pages' => $this->pages,
            'owner' => [
                'user_id' => $this->owner->id,
                'name' => $this->owner->name,
                'email' => $this->owner->email,
            ]
        ];
    }
}
