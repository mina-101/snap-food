<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "description" => $this->description,
            "user_id" => $this->user_id,
            "vendor_id" => $this->vendor_id,
            "delivery_time" => $this->delivery_time,
        ];
    }
}
