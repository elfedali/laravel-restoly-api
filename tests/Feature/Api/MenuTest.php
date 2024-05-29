<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Menu;

use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends TestCase
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
    public function it_gets_menus_list(): void
    {
        $menus = Menu::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.menus.index'));

        $response->assertOk()->assertSee($menus[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_menu(): void
    {
        $data = Menu::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.menus.store'), $data);

        unset($data['slug']);

        $this->assertDatabaseHas('menus', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_menu(): void
    {
        $menu = Menu::factory()->create();

        $restaurant = Restaurant::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'restaurant_id' => $restaurant->id,
        ];

        $response = $this->putJson(route('api.menus.update', $menu), $data);

        unset($data['slug']);

        $data['id'] = $menu->id;

        $this->assertDatabaseHas('menus', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_menu(): void
    {
        $menu = Menu::factory()->create();

        $response = $this->deleteJson(route('api.menus.destroy', $menu));

        $this->assertModelMissing($menu);

        $response->assertNoContent();
    }
}
