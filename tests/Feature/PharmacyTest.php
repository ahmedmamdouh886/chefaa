<?php

namespace Tests\Feature;

use App\Models\Pharmacy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PharmacyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test pharmacy index.
     *
     * @return void
     */
    public function testPharmacyIndex()
    {
        Pharmacy::factory(5)->create();

        $this->get('/api/v1/pharmacies')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [[
                'id',
                'name',
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
     * Test pharmacy show.
     *
     * @return void
     */
    public function testPharmacyShow()
    {
        $pharmacy = Pharmacy::factory()->create([
            'name' => 'Chefaa pharmacy',
            'address' => 'Maadi',
        ]);

        $this->get("/api/v1/pharmacies/{$pharmacy->id}")
        ->assertOk()
        ->assertJson([
            'data' => [
                'id' => $pharmacy->id,
                'name' => $pharmacy->name,
                'address' => $pharmacy->address,
            ],
        ]);
    }

    /**
     * Test store pharmacy.
     *
     * @return void
     */
    public function testStorePharmacy()
    {
        $payload = $this->validPayload();

        $this->post('/api/v1/pharmacies', $payload)
        ->assertCreated()
        ->assertJson([
                'message' => __('messages.created_successfully'),
            ]);

        $this->assertDatabaseHas('pharmacies', $payload);
    }

    /**
     * Test update pharmacy.
     *
     * @return void
     */
    public function testUpdatePharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();
        $payload = $this->validPayload();

        $this->put("/api/v1/pharmacies/{$pharmacy->id}", $payload)
        ->assertNoContent();

        $this->assertDatabaseHas('pharmacies', $payload);
        $this->assertEquals($payload['name'], $payload['name']);
        $this->assertEquals($payload['address'], $payload['address']);
    }

    /**
     * Test update pharmacy.
     *
     * @return void
     */
    public function testDeletePharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $this->delete("/api/v1/pharmacies/{$pharmacy->id}")
        ->assertNoContent();

        $this->assertDatabaseMissing('pharmacies', $pharmacy->toArray());
    }

    /**
     * Valid payload for storing/updating a resource.
     *
     * @return array Valid payload for storing/updating a resource
     */
    private function validPayload()
    {
        return [
            'name' => 'Chefaa pharmacy',
            'address' => 'Maadi',
        ];
    }
}
