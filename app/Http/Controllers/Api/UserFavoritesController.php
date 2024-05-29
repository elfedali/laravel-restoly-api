<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteCollection;

class UserFavoritesController extends Controller
{
    public function index(Request $request, User $user): FavoriteCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $favorites = $user
            ->favorites()
            ->search($search)
            ->latest()
            ->paginate();

        return new FavoriteCollection($favorites);
    }

    public function store(Request $request, User $user): FavoriteResource
    {
        $this->authorize('create', Favorite::class);

        $validated = $request->validate([
            'favoritable_id' => ['required', 'max:255'],
            'favoritable_type' => ['required', 'max:255', 'string'],
        ]);

        $favorite = $user->favorites()->create($validated);

        return new FavoriteResource($favorite);
    }
}
