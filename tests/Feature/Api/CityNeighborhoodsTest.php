<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Neighborhood;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityNeighborhoodsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_city_neighborhoods(): void
    {
        $city = City::factory()->create();
        $neighborhoods = Neighborhood::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(
            route('api.cities.neighborhoods.index', $city)
        );

        $response->assertOk()->assertSee($neighborhoods[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_city_neighborhoods(): void
    {
        $city = City::factory()->create();
        $data = Neighborhood::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.neighborhoods.store', $city),
            $data
        );

        unset($data['slug']);

        $this->assertDatabaseHas('neighborhoods', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $neighborhood = Neighborhood::latest('id')->first();

        $this->assertEquals($city->id, $neighborhood->city_id);
    }
}
