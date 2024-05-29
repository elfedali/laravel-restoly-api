<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Restaurant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_restaurants(): void
    {
        $restaurants = Restaurant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('restaurants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.restaurants.index')
            ->assertViewHas('restaurants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_restaurant(): void
    {
        $response = $this->get(route('restaurants.create'));

        $response->assertOk()->assertViewIs('app.restaurants.create');
    }

    /**
     * @test
     */
    public function it_stores_the_restaurant(): void
    {
        $data = Restaurant::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('restaurants.store'), $data);

        $this->assertDatabaseHas('restaurants', $data);

        $restaurant = Restaurant::latest('id')->first();

        $response->assertRedirect(route('restaurants.edit', $restaurant));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->get(route('restaurants.show', $restaurant));

        $response
            ->assertOk()
            ->assertViewIs('app.restaurants.show')
            ->assertViewHas('restaurant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->get(route('restaurants.edit', $restaurant));

        $response
            ->assertOk()
            ->assertViewIs('app.restaurants.edit')
            ->assertViewHas('restaurant');
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

        $response = $this->put(route('restaurants.update', $restaurant), $data);

        $data['id'] = $restaurant->id;

        $this->assertDatabaseHas('restaurants', $data);

        $response->assertRedirect(route('restaurants.edit', $restaurant));
    }

    /**
     * @test
     */
    public function it_deletes_the_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->delete(route('restaurants.destroy', $restaurant));

        $response->assertRedirect(route('restaurants.index'));

        $this->assertModelMissing($restaurant);
    }
}
