<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]),
            'supplier' => $this->whenLoaded('supplier', fn () => [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
            ]),
            'purchase_price' => (int) $this->purchase_price,
            'selling_price' => (int) $this->selling_price,
            'stock_quantity' => (int) $this->stock_quantity,
            'min_stock' => (int) $this->min_stock,
            'is_low_stock' => $this->stock_quantity <= $this->min_stock,
        ];
    }
}
