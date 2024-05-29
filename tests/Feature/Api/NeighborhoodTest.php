<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Neighborhood;

use App\Models\City;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NeighborhoodTest extends TestCase
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
    public function it_gets_neighborhoods_list(): void
    {
        $neighborhoods = Neighborhood::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.neighborhoods.index'));

        $response->assertOk()->assertSee($neighborhoods[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_neighborhood(): void
    {
        $data = Neighborhood::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.neighborhoods.store'), $data);

        unset($data['slug']);

        $this->assertDatabaseHas('neighborhoods', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_neighborhood(): void
    {
        $neighborhood = Neighborhood::factory()->create();

        $city = City::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'city_id' => $city->id,
        ];

        $response = $this->putJson(
            route('api.neighborhoods.update', $neighborhood),
            $data
        );

        unset($data['slug']);

        $data['id'] = $neighborhood->id;

        $this->assertDatabaseHas('neighborhoods', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_neighborhood(): void
    {
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->deleteJson(
            route('api.neighborhoods.destroy', $neighborhood)
        );

        $this->assertModelMissing($neighborhood);

        $response->assertNoContent();
    }
}
