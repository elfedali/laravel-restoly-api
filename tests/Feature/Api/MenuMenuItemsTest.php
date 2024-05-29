<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Menu;
use App\Models\MenuItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuMenuItemsTest extends TestCase
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
    public function it_gets_menu_menu_items(): void
    {
        $menu = Menu::factory()->create();
        $menuItems = MenuItem::factory()
            ->count(2)
            ->create([
                'menu_id' => $menu->id,
            ]);

        $response = $this->getJson(route('api.menus.menu-items.index', $menu));

        $response->assertOk()->assertSee($menuItems[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_menu_menu_items(): void
    {
        $menu = Menu::factory()->create();
        $data = MenuItem::factory()
            ->make([
                'menu_id' => $menu->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.menus.menu-items.store', $menu),
            $data
        );

        $this->assertDatabaseHas('menu_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $menuItem = MenuItem::latest('id')->first();

        $this->assertEquals($menu->id, $menuItem->menu_id);
    }
}
