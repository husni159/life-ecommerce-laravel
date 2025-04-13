<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    public function test_admin_can_create_product()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $payload = [
            'name' => 'API Product',
            'slug' => 'api-product',
            'description' => 'From API',
            'price' => 25.50,
            'stock_quantity' => 10,
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'API Product']);
    }
}
