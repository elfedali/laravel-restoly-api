<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantCollection;
use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;

class RestaurantController extends Controller
{
    public function index(Request $request): RestaurantCollection
    {
        $this->authorize('view-any', Restaurant::class);

        $search = $request->get('search', '');

        $restaurants = Restaurant::search($search)
            ->latest()
            ->paginate();

        return new RestaurantCollection($restaurants);
    }

    public function store(RestaurantStoreRequest $request): RestaurantResource
    {
        $this->authorize('create', Restaurant::class);

        $validated = $request->validated();
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $restaurant = Restaurant::create($validated);

        return new RestaurantResource($restaurant);
    }

    public function show(
        Request $request,
        Restaurant $restaurant
    ): RestaurantResource {
        $this->authorize('view', $restaurant);

        return new RestaurantResource($restaurant);
    }

    public function update(
        RestaurantUpdateRequest $request,
        Restaurant $restaurant
    ): RestaurantResource {
        $this->authorize('update', $restaurant);

        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($restaurant->thumbnail) {
                Storage::delete($restaurant->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $restaurant->update($validated);

        return new RestaurantResource($restaurant);
    }

    public function destroy(Request $request, Restaurant $restaurant): Response
    {
        $this->authorize('delete', $restaurant);

        if ($restaurant->thumbnail) {
            Storage::delete($restaurant->thumbnail);
        }

        $restaurant->delete();

        return response()->noContent();
    }
}
