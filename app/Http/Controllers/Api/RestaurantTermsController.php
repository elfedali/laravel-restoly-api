<?php
namespace App\Http\Controllers\Api;

use App\Models\Term;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TermCollection;

class RestaurantTermsController extends Controller
{
    public function index(
        Request $request,
        Restaurant $restaurant
    ): TermCollection {
        $this->authorize('view', $restaurant);

        $search = $request->get('search', '');

        $terms = $restaurant
            ->terms()
            ->search($search)
            ->latest()
            ->paginate();

        return new TermCollection($terms);
    }

    public function store(
        Request $request,
        Restaurant $restaurant,
        Term $term
    ): Response {
        $this->authorize('update', $restaurant);

        $restaurant->terms()->syncWithoutDetaching([$term->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Restaurant $restaurant,
        Term $term
    ): Response {
        $this->authorize('update', $restaurant);

        $restaurant->terms()->detach($term);

        return response()->noContent();
    }
}
