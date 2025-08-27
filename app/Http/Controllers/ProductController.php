<?php

namespace App\Http\Controllers;

use App\Models\{Product,Category,Supplier};
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
      
    public function index(Request $request)
    {
        // Inisialisasi query builder dan array filters
        $query = Product::with(['category', 'supplier']);
        $filters = [];
        
        // Filter berdasarkan pencarian nama atau kode
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $filters['search'] = $searchTerm;
            
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('code', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        
        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $filters['category_id'] = $request->category_id;
            $query->where('category_id', $request->category_id);
        }
        
        // Filter berdasarkan supplier
        if ($request->filled('supplier_id')) {
            $filters['supplier_id'] = $request->supplier_id;
            $query->where('supplier_id', $request->supplier_id);
        }
        
        // Filter berdasarkan status stock (opsional)
        if ($request->filled('stock_status')) {
            $filters['stock_status'] = $request->stock_status;
            
            switch ($request->stock_status) {
                case 'low':
                    $query->whereColumn('stock', '<=', 'stock_minimum');
                    break;
                case 'medium':
                    $query->whereColumn('stock', '>', 'stock_minimum')
                          ->whereRaw('stock <= (stock_minimum * 2)');
                    break;
                case 'high':
                    $query->whereRaw('stock > (stock_minimum * 2)');
                    break;
                case 'out':
                    $query->where('stock', 0);
                    break;
            }
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        if (in_array($sortBy, ['name', 'code', 'stock', 'price_sell', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }
        
        // Pagination dengan parameter yang dipertahankan
        $items = $query->paginate(10)->withQueryString();
        
        // Ambil data untuk dropdown filter
        $categories = Category::all();
        $suppliers = Supplier::all();
        
        return view('products.index', compact('items', 'categories', 'suppliers', 'filters'));
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('products.create', compact('categories','suppliers'));
    }

    public function show($id)
{
    $product = Product::with('category')->findOrFail($id);
    return view('products.show', compact('product'));
}


    public function store(Request $r)
    {
        $data = $r->validate([
            'code'          => 'required|unique:products,code',
            'name'          => 'required',
            'category_id'   => 'nullable|exists:categories,id',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            'price_buy'     => 'nullable|numeric',
            'price_sell'    => 'nullable|numeric',
            'stock'         => 'nullable|integer|min:0',
            'stock_minimum' => 'nullable|integer',
            'attributes'    => 'nullable',
            'image'         => 'nullable|file|image|max:2048',
        ]);

        // simpan gambar kalau ada
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('products', 'public');
        }

        // ubah attributes ke array kalau masih string json
        if (!empty($data['attributes']) && is_string($data['attributes'])) {
            $data['attributes'] = json_decode($data['attributes'], true);
        }

        // simpan langsung ke database
        Product::create($data);

        return redirect()->route('products.index')->with('ok', 'Produk berhasil dibuat');
    }

    public function edit(Product $product){
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('products.edit', compact('product','categories','suppliers'));
    }

    public function update(Request $r, Product $product)
    {
        $data = $r->validate([
            'code'          => 'required|unique:products,code,' . $product->id,
            'name'          => 'required',
            'category_id'   => 'nullable|exists:categories,id',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            'price_buy'     => 'nullable|numeric',
            'price_sell'    => 'nullable|numeric',
            'stock'         => 'nullable|integer|min:0',
            'stock_minimum' => 'nullable|integer',
            'attributes'    => 'nullable',
            'image'         => 'nullable|file|image|max:2048',
        ]);

        // update gambar jika ada upload baru
        if ($r->hasFile('image')) {
            $data['image'] = $r->file('image')->store('products', 'public');
        }

        // decode attributes kalau masih string JSON
        if (!empty($data['attributes']) && is_string($data['attributes'])) {
            $data['attributes'] = json_decode($data['attributes'], true);
        }

        // update langsung ke model
        $product->update($data);

        return redirect()->route('products.index')->with('ok', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        // Hapus dulu data relasi
        DB::table('stock_confirmations')->where('product_id', $id)->delete();

        // Baru hapus produk
        Product::destroy($id);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}