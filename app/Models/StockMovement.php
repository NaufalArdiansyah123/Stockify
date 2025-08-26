<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StockMovement extends Model
   {
    protected $fillable = [
    'product_id',
    'type',
    'quantity',
    'note',
    'happened_at',
    'user_id', // ✅ jangan lupa ini
];


    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

  // Scope untuk transaksi hari ini
    public function scopeHariIni($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Scope untuk stock masuk
    public function scopeStockIn($query)
    {
        return $query->where('movement_type', 'in');
    }

    // Scope untuk stock keluar
    public function scopeStockOut($query)
    {
        return $query->where('movement_type', 'out');
    }
    

    protected $casts = [
    'happened_at' => 'datetime',
];

}
    


