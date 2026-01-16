<?php
namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface {
    public function allPaginated(int $perPage = 15);
    public function find(int $id): ?Product;
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
}