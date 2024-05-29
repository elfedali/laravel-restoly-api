<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Meta;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MetaTest extends TestCase
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
    public function it_gets_metas_list(): void
    {
        $metas = Meta::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.metas.index'));

        $response->assertOk()->assertSee($metas[0]->metaable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_meta(): void
    {
        $data = Meta::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.metas.store'), $data);

        $this->assertDatabaseHas('metas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_meta(): void
    {
        $meta = Meta::factory()->create();

        $data = [
            'meta_key' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.metas.update', $meta), $data);

        $data['id'] = $meta->id;

        $this->assertDatabaseHas('metas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_meta(): void
    {
        $meta = Meta::factory()->create();

        $response = $this->deleteJson(route('api.metas.destroy', $meta));

        $this->assertModelMissing($meta);

        $response->assertNoContent();
    }
}
