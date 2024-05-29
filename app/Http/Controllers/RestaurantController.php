<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Restaurant::class);

        $search = $request->get('search', '');

        $restaurants = Restaurant::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.restaurants.index', compact('restaurants', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Restaurant::class);

        $users = User::pluck('name', 'id');

        return view('app.restaurants.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Restaurant::class);

        $validated = $request->validated();
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $restaurant = Restaurant::create($validated);

        return redirect()
            ->route('restaurants.edit', $restaurant)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Restaurant $restaurant): View
    {
        $this->authorize('view', $restaurant);

        return view('app.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Restaurant $restaurant): View
    {
        $this->authorize('update', $restaurant);

        $users = User::pluck('name', 'id');

        return view('app.restaurants.edit', compact('restaurant', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RestaurantUpdateRequest $request,
        Restaurant $restaurant
    ): RedirectResponse {
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

        return redirect()
            ->route('restaurants.edit', $restaurant)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Restaurant $restaurant
    ): RedirectResponse {
        $this->authorize('delete', $restaurant);

        if ($restaurant->thumbnail) {
            Storage::delete($restaurant->thumbnail);
        }

        $restaurant->delete();

        return redirect()
            ->route('restaurants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
