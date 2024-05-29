<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityCollection;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;

class ActivityController extends Controller
{
    public function index(Request $request): ActivityCollection
    {
        $this->authorize('view-any', Activity::class);

        $search = $request->get('search', '');

        $activities = Activity::search($search)
            ->latest()
            ->paginate();

        return new ActivityCollection($activities);
    }

    public function store(ActivityStoreRequest $request): ActivityResource
    {
        $this->authorize('create', Activity::class);

        $validated = $request->validated();

        $activity = Activity::create($validated);

        return new ActivityResource($activity);
    }

    public function show(Request $request, Activity $activity): ActivityResource
    {
        $this->authorize('view', $activity);

        return new ActivityResource($activity);
    }

    public function update(
        ActivityUpdateRequest $request,
        Activity $activity
    ): ActivityResource {
        $this->authorize('update', $activity);

        $validated = $request->validated();

        $activity->update($validated);

        return new ActivityResource($activity);
    }

    public function destroy(Request $request, Activity $activity): Response
    {
        $this->authorize('delete', $activity);

        $activity->delete();

        return response()->noContent();
    }
}
