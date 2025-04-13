<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Response;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use HttpResponses;
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        try{
            $products = $this->productService->getAll();
            return $this->success($products, 'Products retrieved successfully', 200);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function store(StoreProductRequest $request)
    {
        try{
            $product = $this->productService->create($request->validated());
            Log::info($request->validated());

            return $this->success($product, 'Product added successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    // 🔍 Get single product by ID or slug
    public function show($id)
    {
        try{
            $product = $this->productService->getById($id);

            if (!$product) {
                return $this->error(null,'Product not found', 404);
            }
            return $this->success($product, 'Product retrieved successfully', 200);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    //  Filter products by category
    public function filterByCategory($categoryId)
    {
        try{
            $products = $this->productService->filterByCategory($categoryId);
            return $this->success($products, 'Filtered products retrieved successfully', 200);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    //update products
    public function update(UpdateProductRequest $request, $id)
    {  
        try{
            $product = $this->productService->update($id, $request->validated());
            return $this->success($product, 'Product updated successfully', 200);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    //soft delete
    public function destroy($id)
    {
        try{
            $this->productService->delete($id);
            return $this->success(null, 'Product deleted successfully', 200);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
