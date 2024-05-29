<?php

namespace App\Http\Controllers\Api;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NeighborhoodResource;
use App\Http\Resources\NeighborhoodCollection;
use App\Http\Requests\NeighborhoodStoreRequest;
use App\Http\Requests\NeighborhoodUpdateRequest;

class NeighborhoodController extends Controller
{
    public function index(Request $request): NeighborhoodCollection
    {
        $this->authorize('view-any', Neighborhood::class);

        $search = $request->get('search', '');

        $neighborhoods = Neighborhood::search($search)
            ->latest()
            ->paginate();

        return new NeighborhoodCollection($neighborhoods);
    }

    public function store(
        NeighborhoodStoreRequest $request
    ): NeighborhoodResource {
        $this->authorize('create', Neighborhood::class);

        $validated = $request->validated();

        $neighborhood = Neighborhood::create($validated);

        return new NeighborhoodResource($neighborhood);
    }

    public function show(
        Request $request,
        Neighborhood $neighborhood
    ): NeighborhoodResource {
        $this->authorize('view', $neighborhood);

        return new NeighborhoodResource($neighborhood);
    }

    public function update(
        NeighborhoodUpdateRequest $request,
        Neighborhood $neighborhood
    ): NeighborhoodResource {
        $this->authorize('update', $neighborhood);

        $validated = $request->validated();

        $neighborhood->update($validated);

        return new NeighborhoodResource($neighborhood);
    }

    public function destroy(
        Request $request,
        Neighborhood $neighborhood
    ): Response {
        $this->authorize('delete', $neighborhood);

        $neighborhood->delete();

        return response()->noContent();
    }
}
