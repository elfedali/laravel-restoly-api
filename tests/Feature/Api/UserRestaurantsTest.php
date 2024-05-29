<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRestaurantsTest extends TestCase
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
    public function it_gets_user_restaurants(): void
    {
        $user = User::factory()->create();
        $restaurants = Restaurant::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.restaurants.index', $user));

        $response->assertOk()->assertSee($restaurants[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_user_restaurants(): void
    {
        $user = User::factory()->create();
        $data = Restaurant::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.restaurants.store', $user),
            $data
        );

        $this->assertDatabaseHas('restaurants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $restaurant = Restaurant::latest('id')->first();

        $this->assertEquals($user->id, $restaurant->user_id);
    }
}
