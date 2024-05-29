<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantCollection;

class UserRestaurantsController extends Controller
{
    public function index(Request $request, User $user): RestaurantCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $restaurants = $user
            ->restaurants()
            ->search($search)
            ->latest()
            ->paginate();

        return new RestaurantCollection($restaurants);
    }

    public function store(Request $request, User $user): RestaurantResource
    {
        $this->authorize('create', Restaurant::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['nullable', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'excerpt' => ['nullable', 'max:255', 'string'],
            'is_published' => ['required', 'boolean'],
            'comment_status' => ['nullable', 'boolean'],
            'ping_status' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'thumbnail' => ['nullable', 'file'],
            'phone' => ['required', 'max:255', 'string'],
            'phone_2' => ['nullable', 'max:255', 'string'],
            'phone_3' => ['nullable', 'max:255', 'string'],
            'reservation_required' => ['nullable', 'boolean'],
            'website_url' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $restaurant = $user->restaurants()->create($validated);

        return new RestaurantResource($restaurant);
    }
}
