<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Ping;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PingTest extends TestCase
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
    public function it_gets_pings_list(): void
    {
        $pings = Ping::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pings.index'));

        $response->assertOk()->assertSee($pings[0]->pingable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_ping(): void
    {
        $data = Ping::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pings.store'), $data);

        $this->assertDatabaseHas('pings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_ping(): void
    {
        $ping = Ping::factory()->create();

        $data = [
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'note' => $this->faker->text(255),
            'is_active' => $this->faker->boolean(),
        ];

        $response = $this->putJson(route('api.pings.update', $ping), $data);

        $data['id'] = $ping->id;

        $this->assertDatabaseHas('pings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_ping(): void
    {
        $ping = Ping::factory()->create();

        $response = $this->deleteJson(route('api.pings.destroy', $ping));

        $this->assertModelMissing($ping);

        $response->assertNoContent();
    }
}
