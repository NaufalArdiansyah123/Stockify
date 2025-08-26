<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function paginateWithFilters(array $filters = [], int $perPage = 10)
    {
        $q = Product::query()->with(['category','supplier']);

        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $q->where(function($w) use ($s){
                $w->where('name','like',"%$s%")->orWhere('code','like',"%$s%");
            });
        }
        if (!empty($filters['category_id'])) {
            $q->where('category_id', $filters['category_id']);
        }
        return $q->orderBy('name')->paginate($perPage);
    }

    public function create(array $data): Product
    {
        
         return Product::create([
        'code' => 'PRD-' . time(),   // <--- tambahkan ini
        'name' => $data['name'],
        'stock_minimum' => $data['stock_minimum'],
    ]);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

}
