<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MenuItem;

use App\Models\Menu;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuItemTest extends TestCase
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
    public function it_gets_menu_items_list(): void
    {
        $menuItems = MenuItem::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.menu-items.index'));

        $response->assertOk()->assertSee($menuItems[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_menu_item(): void
    {
        $data = MenuItem::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.menu-items.store'), $data);

        $this->assertDatabaseHas('menu_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_menu_item(): void
    {
        $menuItem = MenuItem::factory()->create();

        $menu = Menu::factory()->create();

        $data = [
            'title' => $this->faker->text(255),
            'ingredients' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'is_disponible' => $this->faker->boolean(),
            'is_vegetarian' => $this->faker->boolean(),
            'picture' => $this->faker->text(255),
            'menu_id' => $menu->id,
        ];

        $response = $this->putJson(
            route('api.menu-items.update', $menuItem),
            $data
        );

        $data['id'] = $menuItem->id;

        $this->assertDatabaseHas('menu_items', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_menu_item(): void
    {
        $menuItem = MenuItem::factory()->create();

        $response = $this->deleteJson(
            route('api.menu-items.destroy', $menuItem)
        );

        $this->assertModelMissing($menuItem);

        $response->assertNoContent();
    }
}
