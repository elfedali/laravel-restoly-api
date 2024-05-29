<?php

namespace App\Http\Controllers\Api;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MetaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MetaCollection;
use App\Http\Requests\MetaStoreRequest;
use App\Http\Requests\MetaUpdateRequest;

class MetaController extends Controller
{
    public function index(Request $request): MetaCollection
    {
        $this->authorize('view-any', Meta::class);

        $search = $request->get('search', '');

        $metas = Meta::search($search)
            ->latest()
            ->paginate();

        return new MetaCollection($metas);
    }

    public function store(MetaStoreRequest $request): MetaResource
    {
        $this->authorize('create', Meta::class);

        $validated = $request->validated();

        $meta = Meta::create($validated);

        return new MetaResource($meta);
    }

    public function show(Request $request, Meta $meta): MetaResource
    {
        $this->authorize('view', $meta);

        return new MetaResource($meta);
    }

    public function update(MetaUpdateRequest $request, Meta $meta): MetaResource
    {
        $this->authorize('update', $meta);

        $validated = $request->validated();

        $meta->update($validated);

        return new MetaResource($meta);
    }

    public function destroy(Request $request, Meta $meta): Response
    {
        $this->authorize('delete', $meta);

        $meta->delete();

        return response()->noContent();
    }
}
