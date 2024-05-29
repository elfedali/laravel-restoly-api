<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteCollection;
use App\Http\Requests\FavoriteStoreRequest;
use App\Http\Requests\FavoriteUpdateRequest;

class FavoriteController extends Controller
{
    public function index(Request $request): FavoriteCollection
    {
        $this->authorize('view-any', Favorite::class);

        $search = $request->get('search', '');

        $favorites = Favorite::search($search)
            ->latest()
            ->paginate();

        return new FavoriteCollection($favorites);
    }

    public function store(FavoriteStoreRequest $request): FavoriteResource
    {
        $this->authorize('create', Favorite::class);

        $validated = $request->validated();

        $favorite = Favorite::create($validated);

        return new FavoriteResource($favorite);
    }

    public function show(Request $request, Favorite $favorite): FavoriteResource
    {
        $this->authorize('view', $favorite);

        return new FavoriteResource($favorite);
    }

    public function update(
        FavoriteUpdateRequest $request,
        Favorite $favorite
    ): FavoriteResource {
        $this->authorize('update', $favorite);

        $validated = $request->validated();

        $favorite->update($validated);

        return new FavoriteResource($favorite);
    }

    public function destroy(Request $request, Favorite $favorite): Response
    {
        $this->authorize('delete', $favorite);

        $favorite->delete();

        return response()->noContent();
    }
}
