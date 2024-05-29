<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;

class UserActivitiesController extends Controller
{
    public function index(Request $request, User $user): ActivityCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $activities = $user
            ->activities()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    public function store(Request $request, User $user): ActivityResource
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validate([
            'activity_key' => ['required', 'max:255', 'string'],
            'activity_content' => ['required', 'max:255', 'string'],
        ]);

        $activity = $user->activities()->create($validated);

        return new ActivityResource($activity);
    }
}
