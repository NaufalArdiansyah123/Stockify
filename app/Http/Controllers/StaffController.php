<?php

namespace App\Http\Controllers;

use App\Models\StockConfirmation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Data untuk konfirmasi stok
        $pendingConfirmations = StockConfirmation::with('product', 'requester')
            ->pending()
            ->latest()
            ->get();
        
        // Data untuk statistik (jika diperlukan)
        $totalPending = StockConfirmation::pending()->count();
        $totalApproved = StockConfirmation::approved()->count();
        $totalRejected = StockConfirmation::rejected()->count();
            
        return view('staff.dashboard', compact(
            'pendingConfirmations', 
            'totalPending',
            'totalApproved', 
            'totalRejected'
        ));
    }

public function confirm(Request $request, $id)
{
    $confirmation = StockConfirmation::findOrFail($id);
    
    $request->validate([
        'action' => 'required|in:approve,reject'
    ]);
    
    DB::beginTransaction();
    
    try {
        if ($request->action === 'approve') {
            // Update product stock
            $product = Product::find($confirmation->product_id);
            
            if ($confirmation->type === 'IN') {
                $product->stock += $confirmation->quantity;
            } else {
                // Check if stock is sufficient for OUT transaction
                if ($product->stock < $confirmation->quantity) {
                    return redirect()->back()
                        ->with('error', 'Insufficient stock for product: ' . $product->name);
                }
                $product->stock -= $confirmation->quantity;
            }
            
            $product->save();
            
            // Update confirmation status - PASTIKAN confirmed_at DISET
            $confirmation->update([
                'status' => 'approved',
                'confirmed_by' => auth()->id(),
                'confirmed_at' => now() // INI YANG MENYEBABKAN ERROR JIKA KOLUM TIDAK ADA
            ]);
            
            $message = 'Stock transaction approved successfully.';
        } else {
            // Reject the confirmation - PASTIKAN confirmed_at DISET
            $confirmation->update([
                'status' => 'rejected',
                'confirmed_by' => auth()->id(),
                'confirmed_at' => now() // INI YANG MENYEBABKAN ERROR JIKA KOLUM TIDAK ADA
            ]);
            
            $message = 'Stock transaction rejected.';
        }
        
        DB::commit();
        
        return redirect()->route('staff.dashboard')
            ->with('success', $message);
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        return redirect()->back()
            ->with('error', 'Confirmation failed: ' . $e->getMessage());
    }
}
}