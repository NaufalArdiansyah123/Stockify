<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovementController extends Controller
{
   public function index()
{
    $movements = StockMovement::with(['product','user'])->latest()->paginate(10);

    return view('stock.index', compact('movements'));
}



    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:IN,OUT',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        // simpan transaksi
        $movement = StockMovement::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->qty,
            'note' => $request->note,
            'happened_at' => now(),
            'user_id'      => auth()->id(), 
        ]);

        // update stok
        if ($request->type == 'IN') {
            $product->stock += $request->qty;
        } else {
            $product->stock -= $request->qty;
            if ($product->stock < 0) {
                $product->stock = 0; // biar gak minus
            }
        }
        $product->save();

        return redirect()->route('stock.index')->with('success','Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $stockMovement = StockMovement::findOrFail($id);
        return view('stock.edit', compact('stockMovement'));
    }

    public function update(Request $request, $id)
    {
        $stockMovement = StockMovement::findOrFail($id);
        $product = $stockMovement->product;

        // rollback stok lama dulu
        if ($stockMovement->type == 'IN') {
            $product->stock -= $stockMovement->qty;
        } else {
            $product->stock += $stockMovement->qty;
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:IN,OUT',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        // update data transaksi
        $stockMovement->update([
            'product_id' => $request->product_id,
            'type' => $request->type,
            'qty' => $request->qty,
            'note' => $request->note,
            'happened_at' => now(),
        ]);

        // update stok baru
        $product = Product::findOrFail($request->product_id);
        if ($request->type == 'IN') {
            $product->stock += $request->qty;
        } else {
            $product->stock -= $request->qty;
            if ($product->stock < 0) {
                $product->stock = 0;
            }
        }
        $product->save();

        return redirect()->route('stock.index')->with('success','Transaksi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $stockMovement = StockMovement::findOrFail($id);
        $product = $stockMovement->product;

        // rollback stok jika transaksi dihapus
        if ($stockMovement->type == 'IN') {
            $product->stock -= $stockMovement->qty;
        } else {
            $product->stock += $stockMovement->qty;
        }
        if ($product->stock < 0) {
            $product->stock = 0;
        }
        $product->save();

        $stockMovement->delete();

        return redirect()->route('stock.index')->with('success','Transaksi berhasil dihapus!');
    }

}


