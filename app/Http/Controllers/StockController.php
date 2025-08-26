<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockConfirmation; // TAMBAHKAN INI
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{

    /**
     * Tampilkan daftar stock movement
     */
    public function index()
    {
        $stockMovements = StockMovement::with('product')
            ->latest()
            ->paginate(20);

        return view('stock.index', compact('stockMovements'));
    }

    /**
     * Form tambah stock movement
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock.create', compact('products'));
    }

   public function store(Request $request)
{
    // Validation rules
    $rules = [
        'product_option' => 'required|in:existing,new',
        'type' => 'required|in:IN,OUT',
        'qty' => 'required|integer|min:1',
        'note' => 'nullable|string|max:1000'
    ];

    // Conditional validation based on product_option
    if ($request->product_option === 'existing') {
        $rules['product_id'] = 'required|exists:products,id';
    } else {
        $rules['product_name'] = 'required|string|max:255';
        $rules['category_id'] = 'required|exists:categories,id';
        $rules['supplier_id'] = 'required|exists:suppliers,id';
        $rules['price_buy'] = 'nullable|numeric|min:0';
        $rules['price_sell'] = 'nullable|numeric|min:0';
        $rules['stock_minimum'] = 'nullable|integer|min:0';
    }

    $validated = $request->validate($rules);

    DB::beginTransaction();
    
    try {
        $productId = null;
        
        if ($request->product_option === 'new') {
            // Check if product name already exists
            $existingProduct = Product::where('name', $request->product_name)->first();
            if ($existingProduct) {
                return redirect()->back()
                    ->with('error', 'Product with name "' . $request->product_name . '" already exists!')
                    ->withInput();
            }

            // Generate product code
            $code = $this->generateProductCode($request->product_name);
            
            // Create new product
            $product = Product::create([
                'name' => $request->product_name,
                'code' => $code,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'price_buy' => $request->price_buy ?? 0,
                'price_sell' => $request->price_sell ?? 0,
                'stock' => 0, // Initial stock
                'stock_minimum' => $request->stock_minimum ?? 10
            ]);
            
            $productId = $product->id;
            
            \Log::info('New product created', [
                'product_id' => $productId,
                'name' => $request->product_name,
                'code' => $code
            ]);
        } else {
            $productId = $request->product_id;
        }

        // Get product for stock validation
        $product = Product::find($productId);
        
        // Validate stock for OUT transactions
        if ($request->type === 'OUT' && $product->stock < $request->qty) {
            return redirect()->back()
                ->with('error', 'Insufficient stock! Available: ' . $product->stock . ', Requested: ' . $request->qty)
                ->withInput();
        }

        // Create stock confirmation request (bukan langsung memproses transaksi)
        StockConfirmation::create([
            'product_id' => $productId,
            'quantity' => $request->qty,
            'type' => $request->type,
            'note' => $request->note,
            'status' => 'pending',
            'requested_by' => auth()->id()
        ]);

        // JANGAN update stok produk di sini
        // Stok akan diupdate setelah staff mengonfirmasi
        
        // Log the confirmation request
        \Log::info('Stock confirmation request created', [
            'product_id' => $productId,
            'product_name' => $product->name,
            'type' => $request->type,
            'qty' => $request->qty
        ]);

        DB::commit();
        
        return redirect()->route('stock.index')
            ->with('success', 'Stock change request submitted. Waiting for staff confirmation.');
                        
    } catch (\Exception $e) {
        DB::rollBack();
        
        \Log::error('Stock transaction failed', [
            'error' => $e->getMessage(),
            'request' => $request->all()
        ]);
        
        return redirect()->back()
            ->with('error', 'Transaction failed: ' . $e->getMessage())
            ->withInput();
    }
}

    /**
     * Generate unique product code
     */
    private function generateProductCode($name)
    {
        // Clean name and get first 3 characters
        $cleanName = preg_replace('/[^A-Za-z]/', '', $name);
        $prefix = strtoupper(substr($cleanName, 0, 3));
        
        // If name is too short, use default prefix
        if (strlen($prefix) < 3) {
            $prefix = 'PRD';
        }
        
        // Find next available number
        $lastProduct = Product::where('code', 'like', $prefix . '%')
            ->orderBy('code', 'desc')
            ->first();
        
        if ($lastProduct) {
            // Extract number from last code
            $lastNumber = (int) substr($lastProduct->code, 3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $prefix . sprintf('%03d', $nextNumber);
    }

    /**
     * Hapus stock movement
     */
    public function destroy($id)
    {
        $movement = StockMovement::findOrFail($id);
        $movement->delete();

        return redirect()->route('stock.index')
            ->with('success', 'Stock movement berhasil dihapus.');
    }

    public function chartData()
    {
        $movements = \App\Models\StockMovement::selectRaw('DATE(happened_at) as date, SUM(CASE WHEN type="IN" THEN quantity ELSE -quantity END) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($movements);
    }
}