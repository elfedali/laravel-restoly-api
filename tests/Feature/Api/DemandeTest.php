<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Demande;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DemandeTest extends TestCase
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
    public function it_gets_demandes_list(): void
    {
        $demandes = Demande::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.demandes.index'));

        $response->assertOk()->assertSee($demandes[0]->demandeable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_demande(): void
    {
        $data = Demande::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.demandes.store'), $data);

        $this->assertDatabaseHas('demandes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_demande(): void
    {
        $demande = Demande::factory()->create();

        $user = User::factory()->create();

        $data = [
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.demandes.update', $demande),
            $data
        );

        $data['id'] = $demande->id;

        $this->assertDatabaseHas('demandes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_demande(): void
    {
        $demande = Demande::factory()->create();

        $response = $this->deleteJson(route('api.demandes.destroy', $demande));

        $this->assertModelMissing($demande);

        $response->assertNoContent();
    }
}
