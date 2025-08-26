<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // filter tanggal
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end   = $request->end_date ?? now()->endOfMonth()->toDateString();

        // laporan stok per produk
        $products = Product::with('category', 'supplier')
            ->withSum(['movements as stock_in' => function($q) use ($start, $end) {
                $q->where('type', 'IN')->whereBetween('happened_at', [$start, $end]);
            }], 'quantity')
            ->withSum(['movements as stock_out' => function($q) use ($start, $end) {
                $q->where('type', 'OUT')->whereBetween('happened_at', [$start, $end]);
            }], 'quantity')
            ->get();

        // riwayat transaksi
        $transactions = StockMovement::with('product','user')
            ->whereBetween('happened_at', [$start, $end])
            ->orderBy('happened_at', 'desc')
            ->get();

        return view('reports.index', compact('products','transactions','start','end'));
    }
}
