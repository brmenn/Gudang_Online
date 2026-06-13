<?php

namespace App\Http\Controllers;

use App\Models\StockIn;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with(['item', 'supplier', 'user'])->latest()->paginate(10);
        return view('stock_ins.index', compact('stockIns'));
    }
}
