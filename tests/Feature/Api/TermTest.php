<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Term;

use App\Models\Taxonomy;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TermTest extends TestCase
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
    public function it_gets_terms_list(): void
    {
        $terms = Term::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.terms.index'));

        $response->assertOk()->assertSee($terms[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_term(): void
    {
        $data = Term::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.terms.store'), $data);

        unset($data['taxonomy_id']);

        $this->assertDatabaseHas('terms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_term(): void
    {
        $term = Term::factory()->create();

        $taxonomy = Taxonomy::factory()->create();

        $data = [
            'title' => $this->faker->text(255),
            'slug' => $this->faker->slug(),
            'taxonomy_id' => $taxonomy->id,
        ];

        $response = $this->putJson(route('api.terms.update', $term), $data);

        unset($data['taxonomy_id']);

        $data['id'] = $term->id;

        $this->assertDatabaseHas('terms', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_term(): void
    {
        $term = Term::factory()->create();

        $response = $this->deleteJson(route('api.terms.destroy', $term));

        $this->assertModelMissing($term);

        $response->assertNoContent();
    }
}
