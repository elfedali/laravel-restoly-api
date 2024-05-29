<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Menu;
use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantMenusTest extends TestCase
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
    public function it_gets_restaurant_menus(): void
    {
        $restaurant = Restaurant::factory()->create();
        $menus = Menu::factory()
            ->count(2)
            ->create([
                'restaurant_id' => $restaurant->id,
            ]);

        $response = $this->getJson(
            route('api.restaurants.menus.index', $restaurant)
        );

        $response->assertOk()->assertSee($menus[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_restaurant_menus(): void
    {
        $restaurant = Restaurant::factory()->create();
        $data = Menu::factory()
            ->make([
                'restaurant_id' => $restaurant->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.restaurants.menus.store', $restaurant),
            $data
        );

        unset($data['slug']);

        $this->assertDatabaseHas('menus', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $menu = Menu::latest('id')->first();

        $this->assertEquals($restaurant->id, $menu->restaurant_id);
    }
}
