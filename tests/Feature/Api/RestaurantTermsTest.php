<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Term;
use App\Models\Restaurant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTermsTest extends TestCase
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
    public function it_gets_restaurant_terms(): void
    {
        $restaurant = Restaurant::factory()->create();
        $term = Term::factory()->create();

        $restaurant->terms()->attach($term);

        $response = $this->getJson(
            route('api.restaurants.terms.index', $restaurant)
        );

        $response->assertOk()->assertSee($term->title);
    }

    /**
     * @test
     */
    public function it_can_attach_terms_to_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();
        $term = Term::factory()->create();

        $response = $this->postJson(
            route('api.restaurants.terms.store', [$restaurant, $term])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $restaurant
                ->terms()
                ->where('terms.id', $term->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_terms_from_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();
        $term = Term::factory()->create();

        $response = $this->deleteJson(
            route('api.restaurants.terms.store', [$restaurant, $term])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $restaurant
                ->terms()
                ->where('terms.id', $term->id)
                ->exists()
        );
    }
}
