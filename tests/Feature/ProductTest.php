<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test product index.
     *
     * @return void
     */
    public function testProductIndex()
    {
        Product::factory(5)->create();

        $this->get('/api/v1/products')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [[
                'id',
                'title',
            ]],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    /**
     * Test product show.
     *
     * @return void
     */
    public function testProductShow()
    {
        $product = Product::factory()->create();

        $this->get("/api/v1/products/{$product->id}")
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'pharmacies' => [],
            ],
        ]);
    }

    /**
     * Test store product.
     *
     * @return void
     */
    public function testStoreProduct()
    {
        $payload = $this->validPayload();

        $this->post('/api/v1/products', $payload)
        ->assertCreated()
        ->assertJson([
                'message' => __('messages.created_successfully'),
            ]);

        $this->assertDatabaseHas('products', $payload);
    }

    /**
     * Test update product.
     *
     * @return void
     */
    public function testUpdateProduct()
    {
        $product = Product::factory()->create();
        $payload = $this->validPayload();

        $this->put("/api/v1/products/{$product->id}", $payload)
        ->assertNoContent();

        $this->assertDatabaseHas('products', $payload);
        $this->assertEquals($payload['title'], $payload['title']);
        $this->assertEquals($payload['description'], $payload['description']);
    }

    /**
     * Test update product.
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $this->delete("/api/v1/products/{$product->id}")
        ->assertNoContent();

        $this->assertDatabaseMissing('products', $product->toArray());
    }

    /**
     * Valid payload for storing/updating a resource.
     *
     * @param  array $overrides
     * @return array Valid payload for storing/updating a resource
     */
    private function validPayload($overrides = [])
    {
        return array_merge([
            'title' => 'Panadol',
            'description' => 'It\'s a medication used to treat fever and mild to moderate pain.',
        ], $overrides);
    }
}
