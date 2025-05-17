<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_category_id" => $this->product_category_id,
            "name" => $this->name,
            "slug" => $this->slug,
            "unit" => $this->unit,
            "description" => $this->description,
            "image" => asset(Storage::url($this->image)),
            "stock" => $this->stock,
            "price" => $this->price,
            "notes" => $this->notes,
        ];
    }
}
