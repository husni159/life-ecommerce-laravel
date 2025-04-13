<?php
namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll($perPage = 10)
    {
        return $this->productRepository->all($perPage);
    }

    public function getById($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $data)
    {
        $images = [];

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('products', 'public'); // stored in storage/app/public/products
                $images[] = Storage::url($path); // generates URL like /storage/products/filename.jpg
            }
        }

        $data['images'] = $images;
        return $this->productRepository->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            throw new \Exception('Product not found');
        }

        $images = $product->images ?? [];

        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $imageFile) {
                if (is_file($imageFile)) {
                    $path = $imageFile->store('products', 'public');
                    $images[] = Storage::url($path);
                }
            }
        }

        $data['images'] = $images;
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function filterByCategory($categoryId)
    {
        return $this->productRepository->filterByCategory($categoryId);
    }
}
