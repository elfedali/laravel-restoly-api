<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Favorite;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFavoritesTest extends TestCase
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
    public function it_gets_user_favorites(): void
    {
        $user = User::factory()->create();
        $favorites = Favorite::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.favorites.index', $user));

        $response->assertOk()->assertSee($favorites[0]->favoritable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_user_favorites(): void
    {
        $user = User::factory()->create();
        $data = Favorite::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.favorites.store', $user),
            $data
        );

        $this->assertDatabaseHas('favorites', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $favorite = Favorite::latest('id')->first();

        $this->assertEquals($user->id, $favorite->user_id);
    }
}
