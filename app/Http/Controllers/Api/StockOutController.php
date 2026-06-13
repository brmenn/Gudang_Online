<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockOutResource;
use App\Models\StockOut;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['item', 'user'])
            ->latest()
            ->paginate(50);

        return StockOutResource::collection($stockOuts);
    }

    public function latest()
    {
        $stockOuts = StockOut::with(['item', 'user'])
            ->latest()
            ->take(20)
            ->get();

        return StockOutResource::collection($stockOuts);
    }
}
