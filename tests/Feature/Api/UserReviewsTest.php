<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Review;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserReviewsTest extends TestCase
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
    public function it_gets_user_reviews(): void
    {
        $user = User::factory()->create();
        $reviews = Review::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.reviews.index', $user));

        $response->assertOk()->assertSee($reviews[0]->reviewable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_user_reviews(): void
    {
        $user = User::factory()->create();
        $data = Review::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.reviews.store', $user),
            $data
        );

        $this->assertDatabaseHas('reviews', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $review = Review::latest('id')->first();

        $this->assertEquals($user->id, $review->user_id);
    }
}
