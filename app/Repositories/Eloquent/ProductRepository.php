<?php
// app/Repositories/Eloquent/ProductRepository.php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    public function allPaginated(int $perPage = 15){
        return Product::paginate($perPage);
    }

    public function find(int $id): ?Product{
        return Product::find($id);
    }

    public function create(array $data): Product{
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product{
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): bool{
        return $product->delete();
    }
}