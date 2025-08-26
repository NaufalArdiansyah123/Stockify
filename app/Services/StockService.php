<?php

namespace App\Services;

use App\Models\{Product, StockMovement};
use Illuminate\Support\Facades\DB;

class StockService
{
    public function move(Product $product, string $type, int $quantity, ?int $userId = null, ?string $note = null): StockMovement
    {
        return DB::transaction(function () use ($product, $type, $quantity, $userId, $note) {
            if ($type === 'IN') {
                $product->increment('stock', $quantity);
            } else {
                $product->decrement('stock', $quantity);
            }

            return StockMovement::create([
                'product_id' => $product->id,
                'type' => $type,
                'quantity' => $quantity,
                'happened_at' => now(),
                'user_id' => $userId,
                'note' => $note,
            ]);
        });
    }
}
