<?php
// app/Http/Controllers/StaffController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockConfirmation;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index()
    {
        // Tanggal hari ini
        $today = Carbon::today();

        // Ambil total stok barang yang dikonfirmasi hari ini
        $totalToday = StockMovement::whereDate('created_at', $today)
                        ->sum('quantity');

        return view('staff.dashboard', compact('totalToday'));
    }

    public function dashboard()
    {
        // Request yang masih pending
        $pendingRequests = StockConfirmation::with(['product', 'requester'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Konfirmasi stok terbaru oleh user yang login
        $recentConfirmations = StockMovement::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('staff.dashboard', compact('pendingRequests', 'recentConfirmations'));
    }
    
    public function confirm(Request $request, $id)
    {
        $confirmation = StockConfirmation::findOrFail($id);

        DB::beginTransaction();
        
        try {
            if ($request->action === 'approve') {
                // Update stok produk
                $product = Product::find($confirmation->product_id);
                
                if ($confirmation->type === 'IN') {
                    $product->stock += $confirmation->quantity;
                } else {
                    // Validasi stok cukup untuk transaksi keluar
                    if ($product->stock < $confirmation->quantity) {
                        return redirect()->back()
                            ->with('error', 'Insufficient stock! Cannot approve OUT transaction.');
                    }
                    $product->stock -= $confirmation->quantity;
                }
                
                $product->save();

                // Buat record StockMovement
                StockMovement::create([
                    'product_id' => $confirmation->product_id,
                    'type' => $confirmation->type,
                    'quantity' => $confirmation->quantity,
                    'note' => $confirmation->note . ' (Confirmed by staff: ' . auth()->user()->name . ')',
                    'user_id' => auth()->id(),
                    'happened_at' => now()
                ]);

                $confirmation->update([
                    'status' => 'approved',
                    'confirmed_by' => auth()->id()
                ]);
                
                $message = 'Request approved successfully. Stock updated.';
            } else {
                $confirmation->update([
                    'status' => 'rejected',
                    'confirmed_by' => auth()->id()
                ]);
                
                $message = 'Request rejected.';
            }

            DB::commit();
            
            return redirect()->back()->with('success', $message);
                            
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Stock confirmation failed', [
                'error' => $e->getMessage(),
                'confirmation_id' => $id,
                'action' => $request->action
            ]);
            
            return redirect()->back()
                ->with('error', 'Confirmation failed: ' . $e->getMessage());
        }
    }
    
    public function tasks()
    {
        return view('staff.tasks');
    }
}
