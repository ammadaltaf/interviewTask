<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Product;

class ProductController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(private ProductRepositoryInterface $productRepo){
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Product::class,'product');
    }

    public function index(){
        return response()->json($this->productRepo->allPaginated());
    }

    public function store(StoreProductRequest $request){
        $product = $this->productRepo->create($request->validated());
        return response()->json($product,201);
    }

    public function update(StoreProductRequest $request, Product $product){
        $this->productRepo->update($product,$request->validated());
        return response()->json($product);
    }

    public function destroy(Product $product){
        $this->productRepo->delete($product);
        return response()->noContent();
    }
}