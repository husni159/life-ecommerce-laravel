<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($perPage = 10)
    {
        return Product::with('categories')->paginate($perPage);
    }

    public function find($id)
    {
        return Product::with('categories')->findOrFail($id);
    }

    public function create(array $data)
    {
        try{
            $product = Product::create($data);
            
            if (isset($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }
            return $product;
        }catch(Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function filterByCategory($categoryId)
    {
        return Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->paginate(10);
    }

    public function getTrashed()
    {
        return Product::onlyTrashed()->get();
    }

    public function restore($id)
    {
        return Product::onlyTrashed()->where('id', $id)->restore();
    }
}
