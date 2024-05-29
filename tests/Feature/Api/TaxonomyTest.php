<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Taxonomy;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaxonomyTest extends TestCase
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
    public function it_gets_taxonomies_list(): void
    {
        $taxonomies = Taxonomy::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.taxonomies.index'));

        $response->assertOk()->assertSee($taxonomies[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_taxonomy(): void
    {
        $data = Taxonomy::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.taxonomies.store'), $data);

        $this->assertDatabaseHas('taxonomies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_taxonomy(): void
    {
        $taxonomy = Taxonomy::factory()->create();

        $data = [
            'title' => $this->faker->text(255),
            'slug' => $this->faker->slug(),
        ];

        $response = $this->putJson(
            route('api.taxonomies.update', $taxonomy),
            $data
        );

        $data['id'] = $taxonomy->id;

        $this->assertDatabaseHas('taxonomies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_taxonomy(): void
    {
        $taxonomy = Taxonomy::factory()->create();

        $response = $this->deleteJson(
            route('api.taxonomies.destroy', $taxonomy)
        );

        $this->assertModelMissing($taxonomy);

        $response->assertNoContent();
    }
}
