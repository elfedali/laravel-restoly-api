<?php

namespace App\Http\Controllers\Api;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaxonomyResource;
use App\Http\Resources\TaxonomyCollection;
use App\Http\Requests\TaxonomyStoreRequest;
use App\Http\Requests\TaxonomyUpdateRequest;

class TaxonomyController extends Controller
{
    public function index(Request $request): TaxonomyCollection
    {
        $this->authorize('view-any', Taxonomy::class);

        $search = $request->get('search', '');

        $taxonomies = Taxonomy::search($search)
            ->latest()
            ->paginate();

        return new TaxonomyCollection($taxonomies);
    }

    public function store(TaxonomyStoreRequest $request): TaxonomyResource
    {
        $this->authorize('create', Taxonomy::class);

        $validated = $request->validated();

        $taxonomy = Taxonomy::create($validated);

        return new TaxonomyResource($taxonomy);
    }

    public function show(Request $request, Taxonomy $taxonomy): TaxonomyResource
    {
        $this->authorize('view', $taxonomy);

        return new TaxonomyResource($taxonomy);
    }

    public function update(
        TaxonomyUpdateRequest $request,
        Taxonomy $taxonomy
    ): TaxonomyResource {
        $this->authorize('update', $taxonomy);

        $validated = $request->validated();

        $taxonomy->update($validated);

        return new TaxonomyResource($taxonomy);
    }

    public function destroy(Request $request, Taxonomy $taxonomy): Response
    {
        $this->authorize('delete', $taxonomy);

        $taxonomy->delete();

        return response()->noContent();
    }
}
