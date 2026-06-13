<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Category::count();
        $lowStockItems = Item::whereColumn('stock_quantity', '<=', 'min_stock')->count();
        $recentStockIns = StockIn::with('item')->latest()->take(5)->get();
        $recentStockOuts = StockOut::with('item')->latest()->take(5)->get();

        return view('dashboard', compact('totalItems', 'totalCategories', 'lowStockItems', 'recentStockIns', 'recentStockOuts'));
    }
}
