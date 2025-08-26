<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function index()
    {
        $opnames = StockOpname::with(['product', 'user'])->latest()->get();
        return view('stockopname.index', compact('opnames'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stockopname.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'real_stock' => 'required|integer|min:0',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        $systemStock = $product->stock;
        $realStock = $request->real_stock;
        $difference = $realStock - $systemStock;

        // simpan ke tabel stock_opnames
        StockOpname::create([
            'product_id'   => $product->id,
            'system_stock' => $systemStock,
            'real_stock'   => $realStock,
            'difference'   => $difference,
            'user_id'      => auth()->id(),
            'note'         => $request->note,
        ]);

        // update stok produk sesuai hasil opname
        $product->update(['stock' => $realStock]);

        return redirect()->route('stockopname.index')->with('success', 'Stock opname berhasil disimpan');
    }
}


