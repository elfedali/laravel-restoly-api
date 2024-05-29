<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTest extends TestCase
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
    public function it_gets_restaurants_list(): void
    {
        $restaurants = Restaurant::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.restaurants.index'));

        $response->assertOk()->assertSee($restaurants[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_restaurant(): void
    {
        $data = Restaurant::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.restaurants.store'), $data);

        $this->assertDatabaseHas('restaurants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $user = User::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'excerpt' => $this->faker->text(255),
            'is_published' => $this->faker->boolean(),
            'comment_status' => $this->faker->boolean(),
            'ping_status' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTime(),
            'phone' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->text(255),
            'phone_3' => $this->faker->text(255),
            'reservation_required' => $this->faker->boolean(),
            'website_url' => $this->faker->text(255),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.restaurants.update', $restaurant),
            $data
        );

        $data['id'] = $restaurant->id;

        $this->assertDatabaseHas('restaurants', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->deleteJson(
            route('api.restaurants.destroy', $restaurant)
        );

        $this->assertModelMissing($restaurant);

        $response->assertNoContent();
    }
}
