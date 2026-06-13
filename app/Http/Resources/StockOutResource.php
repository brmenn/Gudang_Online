<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockOutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item' => $this->whenLoaded('item', fn () => [
                'id' => $this->item->id,
                'name' => $this->item->name,
                'sku' => $this->item->sku,
            ]),
            'quantity' => (int) $this->quantity,
            'selling_price' => (int) $this->selling_price,
            'total_price' => (int) $this->total_price,
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ]),
            'notes' => $this->notes,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
