<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Term;
use App\Models\Taxonomy;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaxonomyTermsTest extends TestCase
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
    public function it_gets_taxonomy_terms(): void
    {
        $taxonomy = Taxonomy::factory()->create();
        $terms = Term::factory()
            ->count(2)
            ->create([
                'taxonomy_id' => $taxonomy->id,
            ]);

        $response = $this->getJson(
            route('api.taxonomies.terms.index', $taxonomy)
        );

        $response->assertOk()->assertSee($terms[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_taxonomy_terms(): void
    {
        $taxonomy = Taxonomy::factory()->create();
        $data = Term::factory()
            ->make([
                'taxonomy_id' => $taxonomy->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.taxonomies.terms.store', $taxonomy),
            $data
        );

        unset($data['taxonomy_id']);

        $this->assertDatabaseHas('terms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $term = Term::latest('id')->first();

        $this->assertEquals($taxonomy->id, $term->taxonomy_id);
    }
}
