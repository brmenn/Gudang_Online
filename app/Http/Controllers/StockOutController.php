<?php

namespace App\Http\Controllers;

use App\Models\StockOut;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['item', 'user'])->latest()->paginate(10);
        return view('stock_outs.index', compact('stockOuts'));
    }
}
