<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;

class RestaurantMenusController extends Controller
{
    public function index(
        Request $request,
        Restaurant $restaurant
    ): MenuCollection {
        $this->authorize('view', $restaurant);

        $search = $request->get('search', '');

        $menus = $restaurant
            ->menus()
            ->search($search)
            ->latest()
            ->paginate();

        return new MenuCollection($menus);
    }

    public function store(
        Request $request,
        Restaurant $restaurant
    ): MenuResource {
        $this->authorize('create', Menu::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
        ]);

        $menu = $restaurant->menus()->create($validated);

        return new MenuResource($menu);
    }
}
