<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'qty',
        'note',
        'user_id',
        'timestamp'
    ];

    protected $casts = [
        'qty' => 'integer',
        'timestamp' => 'datetime'
    ];

    /**
     * Relationship to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for IN transactions
     */
    public function scopeStockIn($query)
    {
        return $query->where('type', 'IN');
    }

    /**
     * Scope for OUT transactions
     */
    public function scopeStockOut($query)
    {
        return $query->where('type', 'OUT');
    }

    /**
     * Get formatted type
     */
    public function getFormattedTypeAttribute()
    {
        return $this->type === 'IN' ? 'Stock In' : 'Stock Out';
    }

    /**
     * Get type icon
     */
    public function getTypeIconAttribute()
    {
        return $this->type === 'IN' ? '📈' : '📉';
    }

    /**
     * Get type color
     */
    public function getTypeColorAttribute()
    {
        return $this->type === 'IN' ? 'green' : 'red';
    }
}