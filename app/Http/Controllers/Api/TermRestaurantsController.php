<?php
namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCollection;

class TermRestaurantsController extends Controller
{
    public function index(Request $request, Term $term): RestaurantCollection
    {
        $this->authorize('view', $term);

        $search = $request->get('search', '');

        $restaurants = $term
            ->restaurants()
            ->search($search)
            ->latest()
            ->paginate();

        return new RestaurantCollection($restaurants);
    }

    public function store(
        Request $request,
        Term $term,
        Restaurant $restaurant
    ): Response {
        $this->authorize('update', $term);

        $term->restaurants()->syncWithoutDetaching([$restaurant->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Term $term,
        Restaurant $restaurant
    ): Response {
        $this->authorize('update', $term);

        $term->restaurants()->detach($restaurant);

        return response()->noContent();
    }
}
