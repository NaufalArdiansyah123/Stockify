<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductService
{
    public function __construct(private ProductRepository $repo) {}

    public function list(array $filters = [])
    {
        return $this->repo->paginateWithFilters($filters);
    }

    public function create(array $data): Product
    {
        return $this->repo->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        return $this->repo->update($product, $data);
    }

    public function delete(Product $product): void
    {
        $this->repo->delete($product);
    }
}
