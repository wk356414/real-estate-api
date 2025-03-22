<?php

namespace Tests\Feature;

use App\Models\RealEstate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealEstateTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        RealEstate::factory()->count(5)->create();
        $response = $this->getJson('/api/realstates');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['id', 'name', 'real_state_type', 'city', 'country']
                 ]);
    }

    public function testStoreAndShow()
    {
        $data = [
            'name'             => 'Sample Property',
            'real_state_type'  => 'house',
            'street'           => 'Main Street',
            'external_number'  => 'A1-101',
            'neighborhood'     => 'Downtown',
            'city'             => 'Metropolis',
            'country'          => 'US',
            'rooms'            => 3,
            'bathrooms'        => 1.5,
            'comments'         => 'Great location',
        ];

        $response = $this->postJson('/api/realstates', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Sample Property']);

        $id = $response->json('id');
        $this->getJson("/api/realstates/{$id}")
             ->assertStatus(200)
             ->assertJsonFragment($data);
    }

    public function testUpdate()
    {
        $realEstate = RealEstate::factory()->create([
            'name' => 'Old Name',
            'real_state_type' => 'house',
            'street' => 'Old Street',
            'external_number' => 'B2-202',
            'neighborhood' => 'Old Town',
            'city' => 'Old City',
            'country' => 'US',
            'rooms' => 4,
            'bathrooms' => 2,
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'real_state_type'  => 'house',
            'street' => 'New Street',
            'external_number' => 'B2-202',
            'neighborhood' => 'New Town',
            'city' => 'New City',
            'country' => 'US',
            'rooms' => 5,
            'bathrooms' => 3,
        ];

        $response = $this->putJson("/api/realstates/{$realEstate->id}", $updateData);
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function testDestroy()
    {
        $realEstate = RealEstate::factory()->create([
            'name' => 'Property To Delete',
            'real_state_type' => 'house',
            'street' => 'Delete Street',
            'external_number' => 'C3-303',
            'neighborhood' => 'Delete Town',
            'city' => 'Delete City',
            'country' => 'US',
            'rooms' => 2,
            'bathrooms' => 1,
        ]);

        $response = $this->deleteJson("/api/realstates/{$realEstate->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Property To Delete']);

        // Ensure soft-delete is active:
        $this->assertSoftDeleted('real_estates', ['id' => $realEstate->id]);
    }
}
