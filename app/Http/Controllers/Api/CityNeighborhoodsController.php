<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NeighborhoodResource;
use App\Http\Resources\NeighborhoodCollection;

class CityNeighborhoodsController extends Controller
{
    public function index(Request $request, City $city): NeighborhoodCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $neighborhoods = $city
            ->neighborhoods()
            ->search($search)
            ->latest()
            ->paginate();

        return new NeighborhoodCollection($neighborhoods);
    }

    public function store(Request $request, City $city): NeighborhoodResource
    {
        $this->authorize('create', Neighborhood::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
        ]);

        $neighborhood = $city->neighborhoods()->create($validated);

        return new NeighborhoodResource($neighborhood);
    }
}
