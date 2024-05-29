<?php

namespace App\Http\Controllers\Api;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Resources\TermResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TermCollection;

class TaxonomyTermsController extends Controller
{
    public function index(Request $request, Taxonomy $taxonomy): TermCollection
    {
        $this->authorize('view', $taxonomy);

        $search = $request->get('search', '');

        $terms = $taxonomy
            ->terms()
            ->search($search)
            ->latest()
            ->paginate();

        return new TermCollection($terms);
    }

    public function store(Request $request, Taxonomy $taxonomy): TermResource
    {
        $this->authorize('create', Term::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
        ]);

        $term = $taxonomy->terms()->create($validated);

        return new TermResource($term);
    }
}
