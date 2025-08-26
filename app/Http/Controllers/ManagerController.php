<?php
// app/Http/Controllers/ManagerController.php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function dashboard()
    {
         // Data untuk dashboard
        $totalUsers = User::count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalManagers = User::where('role', 'manager')->count();
        
        // Data stok produk
        $totalProduct = Product::count();
        // Produk dengan stok menipis
        $productStokMenipis = Product::where('stock', '<=', 'stock_minimum')->get();
        $jumlahStokMenipis = $productStokMenipis->count();

        $stockStatus = [
        'out_of_stock' => Product::where('stock', 0)->count(),
        'critical_low' => Product::whereColumn('stock', '<=', DB::raw('stock_minimum * 0.5'))
                                ->where('stock', '>', 0)
                                ->count(),
        'low_stock' => Product::whereColumn('stock', '<=', 'stock_minimum')
                             ->whereColumn('stock', '>', DB::raw('stock_minimum * 0.5'))
                             ->count(),
        'healthy' => Product::whereColumn('stock', '>', 'stock_minimum')->count()
    ];

         // Define app_settings if it doesn't exist
        $app_settings = (object) [
            'app_logo' => 'default-logo.png', // or null if no default
            'app_name' => config('app.name', 'Stockify'),
            'app_version' => '1.0.0'
        ];
        
        // Stock movement masuk hari ini
        $stockMasukHariIni = StockMovement::with(['product', 'user'])
            ->where('type', 'IN') // atau 'masuk'
            ->hariIni()
            ->get();
        
        $totalStockMasukHariIni = $stockMasukHariIni->sum('quantity');
        
        // Stock movement keluar hari ini
        $stockKeluarHariIni = StockMovement::with(['product', 'user'])
            ->where('type', 'Out') // atau 'keluar'
            ->hariIni()
            ->get();
        
        $totalStockKeluarHariIni = $stockKeluarHariIni->sum('quantity');
        
        // Grafik data untuk 7 hari terakhir
        $grafikData = collect();
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $masuk = StockMovement::where('type', 'IN')
                ->whereDate('created_at', $tanggal)
                ->sum('quantity');
            $keluar = StockMovement::where('type', 'OUT')
                ->whereDate('created_at', $tanggal)
                ->sum('quantity');
                
            $grafikData->push([
                'tanggal' => $tanggal->format('d/m'),
                'masuk' => $masuk,
                'keluar' => $keluar
            ]);
        }

        return view('manager.dashboard', compact(
            'app_settings',
            'totalUsers',
            'totalStaff', 
            'totalManagers',
            'totalProduct',
            'jumlahStokMenipis',
            'productStokMenipis',
            'totalStockMasukHariIni',
            'stockMasukHariIni',
            'totalStockKeluarHariIni', 
            'stockKeluarHariIni',
            'grafikData',
            'stockStatus',
        ));
    }

    
    public function users()
    {
         $users = User::all();
        return view('manager.users', compact('users'));
    }
}
