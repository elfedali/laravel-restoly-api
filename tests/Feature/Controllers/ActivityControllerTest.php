<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Activity;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_activities(): void
    {
        $activities = Activity::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('activities.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.activities.index')
            ->assertViewHas('activities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_activity(): void
    {
        $response = $this->get(route('activities.create'));

        $response->assertOk()->assertViewIs('app.activities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_activity(): void
    {
        $data = Activity::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('activities.store'), $data);

        $this->assertDatabaseHas('activities', $data);

        $activity = Activity::latest('id')->first();

        $response->assertRedirect(route('activities.edit', $activity));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_activity(): void
    {
        $activity = Activity::factory()->create();

        $response = $this->get(route('activities.show', $activity));

        $response
            ->assertOk()
            ->assertViewIs('app.activities.show')
            ->assertViewHas('activity');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_activity(): void
    {
        $activity = Activity::factory()->create();

        $response = $this->get(route('activities.edit', $activity));

        $response
            ->assertOk()
            ->assertViewIs('app.activities.edit')
            ->assertViewHas('activity');
    }

    /**
     * @test
     */
    public function it_updates_the_activity(): void
    {
        $activity = Activity::factory()->create();

        $user = User::factory()->create();

        $data = [
            'activity_key' => $this->faker->text(255),
            'activity_content' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('activities.update', $activity), $data);

        $data['id'] = $activity->id;

        $this->assertDatabaseHas('activities', $data);

        $response->assertRedirect(route('activities.edit', $activity));
    }

    /**
     * @test
     */
    public function it_deletes_the_activity(): void
    {
        $activity = Activity::factory()->create();

        $response = $this->delete(route('activities.destroy', $activity));

        $response->assertRedirect(route('activities.index'));

        $this->assertModelMissing($activity);
    }
}
