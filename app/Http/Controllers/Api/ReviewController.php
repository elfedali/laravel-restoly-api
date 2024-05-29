<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewCollection;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;

class ReviewController extends Controller
{
    public function index(Request $request): ReviewCollection
    {
        $this->authorize('view-any', Review::class);

        $search = $request->get('search', '');

        $reviews = Review::search($search)
            ->latest()
            ->paginate();

        return new ReviewCollection($reviews);
    }

    public function store(ReviewStoreRequest $request): ReviewResource
    {
        $this->authorize('create', Review::class);

        $validated = $request->validated();

        $review = Review::create($validated);

        return new ReviewResource($review);
    }

    public function show(Request $request, Review $review): ReviewResource
    {
        $this->authorize('view', $review);

        return new ReviewResource($review);
    }

    public function update(
        ReviewUpdateRequest $request,
        Review $review
    ): ReviewResource {
        $this->authorize('update', $review);

        $validated = $request->validated();

        $review->update($validated);

        return new ReviewResource($review);
    }

    public function destroy(Request $request, Review $review): Response
    {
        $this->authorize('delete', $review);

        $review->delete();

        return response()->noContent();
    }
}
