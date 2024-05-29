<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Review;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
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
    public function it_gets_reviews_list(): void
    {
        $reviews = Review::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.reviews.index'));

        $response->assertOk()->assertSee($reviews[0]->reviewable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_review(): void
    {
        $data = Review::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.reviews.store'), $data);

        $this->assertDatabaseHas('reviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_review(): void
    {
        $review = Review::factory()->create();

        $user = User::factory()->create();

        $data = [
            'content' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(0, 127),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.reviews.update', $review), $data);

        $data['id'] = $review->id;

        $this->assertDatabaseHas('reviews', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_review(): void
    {
        $review = Review::factory()->create();

        $response = $this->deleteJson(route('api.reviews.destroy', $review));

        $this->assertModelMissing($review);

        $response->assertNoContent();
    }
}
