<?php

namespace App\Http\Controllers\Api;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TermResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TermCollection;
use App\Http\Requests\TermStoreRequest;
use App\Http\Requests\TermUpdateRequest;

class TermController extends Controller
{
    public function index(Request $request): TermCollection
    {
        $this->authorize('view-any', Term::class);

        $search = $request->get('search', '');

        $terms = Term::search($search)
            ->latest()
            ->paginate();

        return new TermCollection($terms);
    }

    public function store(TermStoreRequest $request): TermResource
    {
        $this->authorize('create', Term::class);

        $validated = $request->validated();

        $term = Term::create($validated);

        return new TermResource($term);
    }

    public function show(Request $request, Term $term): TermResource
    {
        $this->authorize('view', $term);

        return new TermResource($term);
    }

    public function update(TermUpdateRequest $request, Term $term): TermResource
    {
        $this->authorize('update', $term);

        $validated = $request->validated();

        $term->update($validated);

        return new TermResource($term);
    }

    public function destroy(Request $request, Term $term): Response
    {
        $this->authorize('delete', $term);

        $term->delete();

        return response()->noContent();
    }
}
