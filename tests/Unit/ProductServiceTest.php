<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = app(ProductService::class);
    }

    public function test_it_creates_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Testing product creation',
            'price' => 99.99,
            'stock_quantity' => 50,
        ];

        $product = $this->productService->create($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }
}
