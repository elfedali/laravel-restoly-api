<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewCollection;

class UserReviewsController extends Controller
{
    public function index(Request $request, User $user): ReviewCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $reviews = $user
            ->reviews()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReviewCollection($reviews);
    }

    public function store(Request $request, User $user): ReviewResource
    {
        $this->authorize('create', Review::class);

        $validated = $request->validate([
            'reviewable_id' => ['required', 'max:255'],
            'reviewable_type' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'rating' => ['nullable', 'max:255'],
        ]);

        $review = $user->reviews()->create($validated);

        return new ReviewResource($review);
    }
}
