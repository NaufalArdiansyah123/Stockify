<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'supplier_id',
        'price_buy',
        'price_sell',
        'stock',
        'stock_minimum',
        'attributes',
        'image'
    ];

    protected $casts = [
        'price_buy' => 'decimal:2',
        'price_sell' => 'decimal:2',
        'stock' => 'integer',
        'stock_minimum' => 'integer',
        'attributes' => 'json'
    ];


    public function movements()
    {
        return $this->hasMany(StockMovement::class);
        // atau sesuai dengan nama model yang Anda gunakan untuk stock movements
    }

    /**
     * Relationship to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship to Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

        /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('name', 'LIKE', '%' . $term . '%')
              ->orWhere('code', 'LIKE', '%' . $term . '%')
              ->orWhere('description', 'LIKE', '%' . $term . '%');
        });
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope untuk filter berdasarkan supplier
     */
    public function scopeBySupplier($query, $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }

    /**
     * Scope untuk produk aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk stock rendah
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'stock_minimum');
    }

    /**
     * Accessor untuk status stock
     */
    public function getStockStatusAttribute()
    {
        if ($this->stock == 0) {
            return 'out';
        }
        
        if ($this->stock_minimum && $this->stock <= $this->stock_minimum) {
            return 'low';
        }
        
        if ($this->stock_minimum && $this->stock <= ($this->stock_minimum * 2)) {
            return 'medium';
        }
        
        return 'high';
    }

    // Relasi ke StockMovements - INI YANG MISSING
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    /**
     * Relationship to Stock Transactions
     */
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Check if stock is low
     */
    public function isLowStock()
    {
        return $this->stock <= $this->stock_minimum;
    }

    /**
     * Get formatted price buy
     */
    public function getFormattedPriceBuyAttribute()
    {
        return 'Rp ' . number_format($this->price_buy, 0, ',', '.');
    }

    /**
     * Get formatted price sell
     */
    public function getFormattedPriceSellAttribute()
    {
        return 'Rp ' . number_format($this->price_sell, 0, ',', '.');
    }

    /**
     * Get stock status
     */
    // public function getStockStatusAttribute()
    // {
    //     if ($this->stock <= 0) {
    //         return 'OUT_OF_STOCK';
    //     } elseif ($this->isLowStock()) {
    //         return 'LOW_STOCK';
    //     } else {
    //         return 'IN_STOCK';
    //     }
    // }

    /**
     * Get stock status color
     */
    public function getStockStatusColorAttribute()
    {
        switch ($this->stock_status) {
            case 'OUT_OF_STOCK':
                return 'red';
            case 'LOW_STOCK':
                return 'yellow';
            default:
                return 'green';
        }
    }
}