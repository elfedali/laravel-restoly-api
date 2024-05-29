<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuItemCollection;
use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Requests\MenuItemUpdateRequest;

class MenuItemController extends Controller
{
    public function index(Request $request): MenuItemCollection
    {
        $this->authorize('view-any', MenuItem::class);

        $search = $request->get('search', '');

        $menuItems = MenuItem::search($search)
            ->latest()
            ->paginate();

        return new MenuItemCollection($menuItems);
    }

    public function store(MenuItemStoreRequest $request): MenuItemResource
    {
        $this->authorize('create', MenuItem::class);

        $validated = $request->validated();
        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('public');
        }

        $menuItem = MenuItem::create($validated);

        return new MenuItemResource($menuItem);
    }

    public function show(Request $request, MenuItem $menuItem): MenuItemResource
    {
        $this->authorize('view', $menuItem);

        return new MenuItemResource($menuItem);
    }

    public function update(
        MenuItemUpdateRequest $request,
        MenuItem $menuItem
    ): MenuItemResource {
        $this->authorize('update', $menuItem);

        $validated = $request->validated();

        if ($request->hasFile('picture')) {
            if ($menuItem->picture) {
                Storage::delete($menuItem->picture);
            }

            $validated['picture'] = $request->file('picture')->store('public');
        }

        $menuItem->update($validated);

        return new MenuItemResource($menuItem);
    }

    public function destroy(Request $request, MenuItem $menuItem): Response
    {
        $this->authorize('delete', $menuItem);

        if ($menuItem->picture) {
            Storage::delete($menuItem->picture);
        }

        $menuItem->delete();

        return response()->noContent();
    }
}
