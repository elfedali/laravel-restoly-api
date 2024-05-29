<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Term;
use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TermRestaurantsTest extends TestCase
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
    public function it_gets_term_restaurants(): void
    {
        $term = Term::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $term->restaurants()->attach($restaurant);

        $response = $this->getJson(route('api.terms.restaurants.index', $term));

        $response->assertOk()->assertSee($restaurant->title);
    }

    /**
     * @test
     */
    public function it_can_attach_restaurants_to_term(): void
    {
        $term = Term::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $response = $this->postJson(
            route('api.terms.restaurants.store', [$term, $restaurant])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $term
                ->restaurants()
                ->where('restaurants.id', $restaurant->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_restaurants_from_term(): void
    {
        $term = Term::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $response = $this->deleteJson(
            route('api.terms.restaurants.store', [$term, $restaurant])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $term
                ->restaurants()
                ->where('restaurants.id', $restaurant->id)
                ->exists()
        );
    }
}
