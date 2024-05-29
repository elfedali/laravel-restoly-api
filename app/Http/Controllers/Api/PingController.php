<?php

namespace App\Http\Controllers\Api;

use App\Models\Ping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PingResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PingCollection;
use App\Http\Requests\PingStoreRequest;
use App\Http\Requests\PingUpdateRequest;

class PingController extends Controller
{
    public function index(Request $request): PingCollection
    {
        $this->authorize('view-any', Ping::class);

        $search = $request->get('search', '');

        $pings = Ping::search($search)
            ->latest()
            ->paginate();

        return new PingCollection($pings);
    }

    public function store(PingStoreRequest $request): PingResource
    {
        $this->authorize('create', Ping::class);

        $validated = $request->validated();

        $ping = Ping::create($validated);

        return new PingResource($ping);
    }

    public function show(Request $request, Ping $ping): PingResource
    {
        $this->authorize('view', $ping);

        return new PingResource($ping);
    }

    public function update(PingUpdateRequest $request, Ping $ping): PingResource
    {
        $this->authorize('update', $ping);

        $validated = $request->validated();

        $ping->update($validated);

        return new PingResource($ping);
    }

    public function destroy(Request $request, Ping $ping): Response
    {
        $this->authorize('delete', $ping);

        $ping->delete();

        return response()->noContent();
    }
}
