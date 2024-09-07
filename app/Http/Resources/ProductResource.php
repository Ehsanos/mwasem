<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $with = ['category'];

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "category" => new CategoryResource($this->category),
            "user" => $this->user,
            "start" => $this->start,
            "end" => $this->end,
            "is_active" => $this->is_active,
            "price_before" => $this->price_before,
            "price_after" => $this->price_after,
            "quantity" => $this->quantity,
            "description" => $this->description,
            "city" => new CityResource($this->city),
            "image" => $this->getImage('products'),
            "images"=>$this->getImages('products'),
        ];
    }
}
