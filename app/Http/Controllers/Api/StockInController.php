<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockInResource;
use App\Models\StockIn;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with(['item', 'supplier', 'user'])
            ->latest()
            ->paginate(50);

        return StockInResource::collection($stockIns);
    }

    public function latest()
    {
        $stockIns = StockIn::with(['item', 'supplier', 'user'])
            ->latest()
            ->take(20)
            ->get();

        return StockInResource::collection($stockIns);
    }
}
