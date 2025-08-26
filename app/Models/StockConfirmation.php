<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'quantity', 'type', 'note', 
        'status', 'requested_by', 'confirmed_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}