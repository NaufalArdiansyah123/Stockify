<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\StockOpname;
// use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan
        $products = Product::count();
        $in = StockMovement::where('type','IN')
                ->whereMonth('happened_at', now()->month)
                ->count();
        $out = StockMovement::where('type','OUT')
                ->whereMonth('happened_at', now()->month)
                ->count();
        $lowStock = Product::whereColumn('stock', '<=', 'stock_minimum')->count();

       // Ambil data stok masuk & keluar per bulan
    $raw = StockMovement::select(
        DB::raw('MONTH(happened_at) as month'),
        DB::raw('SUM(CASE WHEN type="IN" THEN quantity ELSE 0 END) as total_in'),
        DB::raw('SUM(CASE WHEN type="OUT" THEN quantity ELSE 0 END) as total_out')
    )
    ->whereYear('happened_at', now()->year)
    ->groupBy('month')
    ->get()
    ->keyBy('month');

    // Ambil data stock opname
    $rawOp = StockOpname::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('SUM(difference) as total_diff')
    )
    ->whereYear('created_at', now()->year)
    ->groupBy('month')
    ->get()
    ->keyBy('month');

    // Buat array 12 bulan penuh
    $chartData = [];
    for ($i = 1; $i <= 12; $i++) {
        $chartData[] = [
            'month'      => $i,
            'total_in'   => $raw[$i]->total_in ?? 0,
            'total_out'  => $raw[$i]->total_out ?? 0,
        ];
    }

    $opnameData = [];
    for ($i = 1; $i <= 12; $i++) {
        $opnameData[] = [
            'month'       => $i,
            'total_diff'  => $rawOp[$i]->total_diff ?? 0,
        ];
    }

    // $chartData = StockMovement::select(
    //         DB::raw('MONTH(happened_at) as month'),
    //         DB::raw("SUM(CASE WHEN type = 'IN' THEN quantity ELSE 0 END) as total_in"),
    //         DB::raw("SUM(CASE WHEN type = 'OUT' THEN quantity ELSE 0 END) as total_out")
    //     )
    //     ->whereYear('happened_at', now()->year)
    //     ->groupBy('month')
    //     ->orderBy('month')
    //     ->get();


    // recent activity seperti sebelumnya (opsional)
    $recent = StockMovement::with('product')->latest('happened_at')->limit(10)->get();

       return view('dashboard', compact(
        'products',
        'in',
        'out',
        'lowStock',
        'recent',
        'chartData',
        'opnameData'
       ));

    }
};
