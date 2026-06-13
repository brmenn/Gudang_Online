<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['category', 'supplier'])->latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('items.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:items,sku',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $item = Item::create($request->all());

        if ($item->stock_quantity > 0) {
            StockIn::create([
                'item_id' => $item->id,
                'quantity' => $item->stock_quantity,
                'purchase_price' => $item->purchase_price,
                'total_price' => $item->stock_quantity * $item->purchase_price,
                'supplier_id' => $item->supplier_id,
                'user_id' => auth()->id(),
                'notes' => 'Stok awal',
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('items.edit', compact('item', 'categories', 'suppliers'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:50|unique:items,sku,' . $item->id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $oldStock = $item->stock_quantity;
        $item->update($request->all());
        $diff = $item->stock_quantity - $oldStock;

        if ($diff > 0) {
            StockIn::create([
                'item_id' => $item->id,
                'quantity' => $diff,
                'purchase_price' => $item->purchase_price,
                'total_price' => $diff * $item->purchase_price,
                'supplier_id' => $item->supplier_id,
                'user_id' => auth()->id(),
                'notes' => 'Penyesuaian stok (tambah)',
            ]);
        } elseif ($diff < 0) {
            StockOut::create([
                'item_id' => $item->id,
                'quantity' => abs($diff),
                'selling_price' => $item->selling_price,
                'total_price' => abs($diff) * $item->selling_price,
                'user_id' => auth()->id(),
                'notes' => 'Penyesuaian stok (kurang)',
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
