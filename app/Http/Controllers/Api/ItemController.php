<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['category', 'supplier'])->get();
        return ItemResource::collection($items);
    }

    public function show(Item $item)
    {
        $item->load(['category', 'supplier']);
        return new ItemResource($item);
    }

    public function updateStock(Request $request, Item $item)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'type' => 'required|in:in,out',
            'notes' => 'nullable|string|max:255',
        ]);

        $quantity = $request->integer('quantity');
        $type = $request->input('type');

        return DB::transaction(function () use ($item, $quantity, $type, $request) {
            if ($type === 'in') {
                $item->increment('stock_quantity', $quantity);
                $item->stockIns()->create([
                    'quantity' => $quantity,
                    'purchase_price' => $item->purchase_price,
                    'total_price' => $quantity * $item->purchase_price,
                    'supplier_id' => $item->supplier_id,
                    'user_id' => 1,
                    'notes' => $request->input('notes', 'API: Stok masuk'),
                ]);
            } else {
                if ($item->stock_quantity < $quantity) {
                    return response()->json([
                        'message' => 'Stock tidak mencukupi',
                        'available' => $item->stock_quantity,
                    ], 400);
                }

                $item->decrement('stock_quantity', $quantity);
                $item->stockOuts()->create([
                    'quantity' => $quantity,
                    'selling_price' => $item->selling_price,
                    'total_price' => $quantity * $item->selling_price,
                    'user_id' => 1,
                    'notes' => $request->input('notes', 'API: Stok keluar'),
                ]);
            }

            $item->load(['category', 'supplier']);
            return new ItemResource($item);
        });
    }
}
