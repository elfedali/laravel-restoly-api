<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuItemCollection;

class MenuMenuItemsController extends Controller
{
    public function index(Request $request, Menu $menu): MenuItemCollection
    {
        $this->authorize('view', $menu);

        $search = $request->get('search', '');

        $menuItems = $menu
            ->menuItems()
            ->search($search)
            ->latest()
            ->paginate();

        return new MenuItemCollection($menuItems);
    }

    public function store(Request $request, Menu $menu): MenuItemResource
    {
        $this->authorize('create', MenuItem::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'ingredients' => ['nullable', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
            'is_disponible' => ['required', 'boolean'],
            'is_vegetarian' => ['nullable', 'boolean'],
            'picture' => ['image', 'max:1024', 'nullable'],
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('public');
        }

        $menuItem = $menu->menuItems()->create($validated);

        return new MenuItemResource($menuItem);
    }
}
