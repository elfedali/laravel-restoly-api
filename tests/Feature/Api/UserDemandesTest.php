<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Demande;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDemandesTest extends TestCase
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
    public function it_gets_user_demandes(): void
    {
        $user = User::factory()->create();
        $demandes = Demande::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.demandes.index', $user));

        $response->assertOk()->assertSee($demandes[0]->demandeable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_user_demandes(): void
    {
        $user = User::factory()->create();
        $data = Demande::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.demandes.store', $user),
            $data
        );

        $this->assertDatabaseHas('demandes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $demande = Demande::latest('id')->first();

        $this->assertEquals($user->id, $demande->user_id);
    }
}
