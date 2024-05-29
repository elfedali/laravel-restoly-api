<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\MetaController;
use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DemandeController;
use App\Http\Controllers\Api\TaxonomyController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserReviewsController;
use App\Http\Controllers\Api\UserDemandesController;
use App\Http\Controllers\Api\NeighborhoodController;
use App\Http\Controllers\Api\UserFavoritesController;
use App\Http\Controllers\Api\MenuMenuItemsController;
use App\Http\Controllers\Api\TaxonomyTermsController;
use App\Http\Controllers\Api\CountryCitiesController;
use App\Http\Controllers\Api\UserActivitiesController;
use App\Http\Controllers\Api\UserRestaurantsController;
use App\Http\Controllers\Api\RestaurantMenusController;
use App\Http\Controllers\Api\RestaurantTermsController;
use App\Http\Controllers\Api\TermRestaurantsController;
use App\Http\Controllers\Api\CityNeighborhoodsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name(
        'users.store'
    );
    Route::get('/users/{user}', [UserController::class, 'show'])->name(
        'users.show'
    );
    Route::put('/users/{user}', [UserController::class, 'update'])->name(
        'users.update'
    );
    Route::delete('/users/{user}', [
        UserController::class,
        'destroy',
    ])->name('users.destroy');

    // User Restaurants
    Route::get('/users/{user}/restaurants', [
        UserRestaurantsController::class,
        'index',
    ])->name('users.restaurants.index');
    Route::post('/users/{user}/restaurants', [
        UserRestaurantsController::class,
        'store',
    ])->name('users.restaurants.store');

    // User Demandes
    Route::get('/users/{user}/demandes', [
        UserDemandesController::class,
        'index',
    ])->name('users.demandes.index');
    Route::post('/users/{user}/demandes', [
        UserDemandesController::class,
        'store',
    ])->name('users.demandes.store');

    // User Favorites
    Route::get('/users/{user}/favorites', [
        UserFavoritesController::class,
        'index',
    ])->name('users.favorites.index');
    Route::post('/users/{user}/favorites', [
        UserFavoritesController::class,
        'store',
    ])->name('users.favorites.store');

    // User Reviews
    Route::get('/users/{user}/reviews', [
        UserReviewsController::class,
        'index',
    ])->name('users.reviews.index');
    Route::post('/users/{user}/reviews', [
        UserReviewsController::class,
        'store',
    ])->name('users.reviews.store');

    // User Activities
    Route::get('/users/{user}/activities', [
        UserActivitiesController::class,
        'index',
    ])->name('users.activities.index');
    Route::post('/users/{user}/activities', [
        UserActivitiesController::class,
        'store',
    ])->name('users.activities.store');

    Route::get('/menus', [MenuController::class, 'index'])->name(
        'menus.index'
    );
    Route::post('/menus', [MenuController::class, 'store'])->name(
        'menus.store'
    );
    Route::get('/menus/{menu}', [MenuController::class, 'show'])->name(
        'menus.show'
    );
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name(
        'menus.update'
    );
    Route::delete('/menus/{menu}', [
        MenuController::class,
        'destroy',
    ])->name('menus.destroy');

    // Menu Menu Items
    Route::get('/menus/{menu}/menu-items', [
        MenuMenuItemsController::class,
        'index',
    ])->name('menus.menu-items.index');
    Route::post('/menus/{menu}/menu-items', [
        MenuMenuItemsController::class,
        'store',
    ])->name('menus.menu-items.store');

    Route::get('/taxonomies', [TaxonomyController::class, 'index'])->name(
        'taxonomies.index'
    );
    Route::post('/taxonomies', [TaxonomyController::class, 'store'])->name(
        'taxonomies.store'
    );
    Route::get('/taxonomies/{taxonomy}', [
        TaxonomyController::class,
        'show',
    ])->name('taxonomies.show');
    Route::put('/taxonomies/{taxonomy}', [
        TaxonomyController::class,
        'update',
    ])->name('taxonomies.update');
    Route::delete('/taxonomies/{taxonomy}', [
        TaxonomyController::class,
        'destroy',
    ])->name('taxonomies.destroy');

    // Taxonomy Terms
    Route::get('/taxonomies/{taxonomy}/terms', [
        TaxonomyTermsController::class,
        'index',
    ])->name('taxonomies.terms.index');
    Route::post('/taxonomies/{taxonomy}/terms', [
        TaxonomyTermsController::class,
        'store',
    ])->name('taxonomies.terms.store');

    Route::get('/reviews', [ReviewController::class, 'index'])->name(
        'reviews.index'
    );
    Route::post('/reviews', [ReviewController::class, 'store'])->name(
        'reviews.store'
    );
    Route::get('/reviews/{review}', [
        ReviewController::class,
        'show',
    ])->name('reviews.show');
    Route::put('/reviews/{review}', [
        ReviewController::class,
        'update',
    ])->name('reviews.update');
    Route::delete('/reviews/{review}', [
        ReviewController::class,
        'destroy',
    ])->name('reviews.destroy');

    Route::get('/restaurants', [
        RestaurantController::class,
        'index',
    ])->name('restaurants.index');
    Route::post('/restaurants', [
        RestaurantController::class,
        'store',
    ])->name('restaurants.store');
    Route::get('/restaurants/{restaurant}', [
        RestaurantController::class,
        'show',
    ])->name('restaurants.show');
    Route::put('/restaurants/{restaurant}', [
        RestaurantController::class,
        'update',
    ])->name('restaurants.update');
    Route::delete('/restaurants/{restaurant}', [
        RestaurantController::class,
        'destroy',
    ])->name('restaurants.destroy');

    // Restaurant Menus
    Route::get('/restaurants/{restaurant}/menus', [
        RestaurantMenusController::class,
        'index',
    ])->name('restaurants.menus.index');
    Route::post('/restaurants/{restaurant}/menus', [
        RestaurantMenusController::class,
        'store',
    ])->name('restaurants.menus.store');

    // Restaurant Terms
    Route::get('/restaurants/{restaurant}/terms', [
        RestaurantTermsController::class,
        'index',
    ])->name('restaurants.terms.index');
    Route::post('/restaurants/{restaurant}/terms/{term}', [
        RestaurantTermsController::class,
        'store',
    ])->name('restaurants.terms.store');
    Route::delete('/restaurants/{restaurant}/terms/{term}', [
        RestaurantTermsController::class,
        'destroy',
    ])->name('restaurants.terms.destroy');

    Route::get('/countries', [CountryController::class, 'index'])->name(
        'countries.index'
    );
    Route::post('/countries', [CountryController::class, 'store'])->name(
        'countries.store'
    );
    Route::get('/countries/{country}', [
        CountryController::class,
        'show',
    ])->name('countries.show');
    Route::put('/countries/{country}', [
        CountryController::class,
        'update',
    ])->name('countries.update');
    Route::delete('/countries/{country}', [
        CountryController::class,
        'destroy',
    ])->name('countries.destroy');

    // Country Cities
    Route::get('/countries/{country}/cities', [
        CountryCitiesController::class,
        'index',
    ])->name('countries.cities.index');
    Route::post('/countries/{country}/cities', [
        CountryCitiesController::class,
        'store',
    ])->name('countries.cities.store');

    Route::get('/cities', [CityController::class, 'index'])->name(
        'cities.index'
    );
    Route::post('/cities', [CityController::class, 'store'])->name(
        'cities.store'
    );
    Route::get('/cities/{city}', [CityController::class, 'show'])->name(
        'cities.show'
    );
    Route::put('/cities/{city}', [CityController::class, 'update'])->name(
        'cities.update'
    );
    Route::delete('/cities/{city}', [
        CityController::class,
        'destroy',
    ])->name('cities.destroy');

    // City Neighborhoods
    Route::get('/cities/{city}/neighborhoods', [
        CityNeighborhoodsController::class,
        'index',
    ])->name('cities.neighborhoods.index');
    Route::post('/cities/{city}/neighborhoods', [
        CityNeighborhoodsController::class,
        'store',
    ])->name('cities.neighborhoods.store');

    Route::get('/activities', [ActivityController::class, 'index'])->name(
        'activities.index'
    );
    Route::post('/activities', [ActivityController::class, 'store'])->name(
        'activities.store'
    );
    Route::get('/activities/{activity}', [
        ActivityController::class,
        'show',
    ])->name('activities.show');
    Route::put('/activities/{activity}', [
        ActivityController::class,
        'update',
    ])->name('activities.update');
    Route::delete('/activities/{activity}', [
        ActivityController::class,
        'destroy',
    ])->name('activities.destroy');

    Route::get('/reviews', [ReviewController::class, 'index'])->name(
        'reviews.index'
    );
    Route::post('/reviews', [ReviewController::class, 'store'])->name(
        'reviews.store'
    );
    Route::get('/reviews/{review}', [
        ReviewController::class,
        'show',
    ])->name('reviews.show');
    Route::put('/reviews/{review}', [
        ReviewController::class,
        'update',
    ])->name('reviews.update');
    Route::delete('/reviews/{review}', [
        ReviewController::class,
        'destroy',
    ])->name('reviews.destroy');

    Route::get('/demandes', [DemandeController::class, 'index'])->name(
        'demandes.index'
    );
    Route::post('/demandes', [DemandeController::class, 'store'])->name(
        'demandes.store'
    );
    Route::get('/demandes/{demande}', [
        DemandeController::class,
        'show',
    ])->name('demandes.show');
    Route::put('/demandes/{demande}', [
        DemandeController::class,
        'update',
    ])->name('demandes.update');
    Route::delete('/demandes/{demande}', [
        DemandeController::class,
        'destroy',
    ])->name('demandes.destroy');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name(
        'favorites.index'
    );
    Route::post('/favorites', [FavoriteController::class, 'store'])->name(
        'favorites.store'
    );
    Route::get('/favorites/{favorite}', [
        FavoriteController::class,
        'show',
    ])->name('favorites.show');
    Route::put('/favorites/{favorite}', [
        FavoriteController::class,
        'update',
    ])->name('favorites.update');
    Route::delete('/favorites/{favorite}', [
        FavoriteController::class,
        'destroy',
    ])->name('favorites.destroy');

    Route::get('/metas', [MetaController::class, 'index'])->name(
        'metas.index'
    );
    Route::post('/metas', [MetaController::class, 'store'])->name(
        'metas.store'
    );
    Route::get('/metas/{meta}', [MetaController::class, 'show'])->name(
        'metas.show'
    );
    Route::put('/metas/{meta}', [MetaController::class, 'update'])->name(
        'metas.update'
    );
    Route::delete('/metas/{meta}', [
        MetaController::class,
        'destroy',
    ])->name('metas.destroy');

    Route::get('/pings', [PingController::class, 'index'])->name(
        'pings.index'
    );
    Route::post('/pings', [PingController::class, 'store'])->name(
        'pings.store'
    );
    Route::get('/pings/{ping}', [PingController::class, 'show'])->name(
        'pings.show'
    );
    Route::put('/pings/{ping}', [PingController::class, 'update'])->name(
        'pings.update'
    );
    Route::delete('/pings/{ping}', [
        PingController::class,
        'destroy',
    ])->name('pings.destroy');

    Route::get('/promotions', [PromotionController::class, 'index'])->name(
        'promotions.index'
    );
    Route::post('/promotions', [PromotionController::class, 'store'])->name(
        'promotions.store'
    );
    Route::get('/promotions/{promotion}', [
        PromotionController::class,
        'show',
    ])->name('promotions.show');
    Route::put('/promotions/{promotion}', [
        PromotionController::class,
        'update',
    ])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [
        PromotionController::class,
        'destroy',
    ])->name('promotions.destroy');

    Route::get('/menu-items', [MenuItemController::class, 'index'])->name(
        'menu-items.index'
    );
    Route::post('/menu-items', [MenuItemController::class, 'store'])->name(
        'menu-items.store'
    );
    Route::get('/menu-items/{menuItem}', [
        MenuItemController::class,
        'show',
    ])->name('menu-items.show');
    Route::put('/menu-items/{menuItem}', [
        MenuItemController::class,
        'update',
    ])->name('menu-items.update');
    Route::delete('/menu-items/{menuItem}', [
        MenuItemController::class,
        'destroy',
    ])->name('menu-items.destroy');

    Route::get('/neighborhoods', [
        NeighborhoodController::class,
        'index',
    ])->name('neighborhoods.index');
    Route::post('/neighborhoods', [
        NeighborhoodController::class,
        'store',
    ])->name('neighborhoods.store');
    Route::get('/neighborhoods/{neighborhood}', [
        NeighborhoodController::class,
        'show',
    ])->name('neighborhoods.show');
    Route::put('/neighborhoods/{neighborhood}', [
        NeighborhoodController::class,
        'update',
    ])->name('neighborhoods.update');
    Route::delete('/neighborhoods/{neighborhood}', [
        NeighborhoodController::class,
        'destroy',
    ])->name('neighborhoods.destroy');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name(
        'favorites.index'
    );
    Route::post('/favorites', [FavoriteController::class, 'store'])->name(
        'favorites.store'
    );
    Route::get('/favorites/{favorite}', [
        FavoriteController::class,
        'show',
    ])->name('favorites.show');
    Route::put('/favorites/{favorite}', [
        FavoriteController::class,
        'update',
    ])->name('favorites.update');
    Route::delete('/favorites/{favorite}', [
        FavoriteController::class,
        'destroy',
    ])->name('favorites.destroy');

    Route::get('/demandes', [DemandeController::class, 'index'])->name(
        'demandes.index'
    );
    Route::post('/demandes', [DemandeController::class, 'store'])->name(
        'demandes.store'
    );
    Route::get('/demandes/{demande}', [
        DemandeController::class,
        'show',
    ])->name('demandes.show');
    Route::put('/demandes/{demande}', [
        DemandeController::class,
        'update',
    ])->name('demandes.update');
    Route::delete('/demandes/{demande}', [
        DemandeController::class,
        'destroy',
    ])->name('demandes.destroy');

    Route::get('/terms', [TermController::class, 'index'])->name(
        'terms.index'
    );
    Route::post('/terms', [TermController::class, 'store'])->name(
        'terms.store'
    );
    Route::get('/terms/{term}', [TermController::class, 'show'])->name(
        'terms.show'
    );
    Route::put('/terms/{term}', [TermController::class, 'update'])->name(
        'terms.update'
    );
    Route::delete('/terms/{term}', [
        TermController::class,
        'destroy',
    ])->name('terms.destroy');

    // Term Restaurants
    Route::get('/terms/{term}/restaurants', [
        TermRestaurantsController::class,
        'index',
    ])->name('terms.restaurants.index');
    Route::post('/terms/{term}/restaurants/{restaurant}', [
        TermRestaurantsController::class,
        'store',
    ])->name('terms.restaurants.store');
    Route::delete('/terms/{term}/restaurants/{restaurant}', [
        TermRestaurantsController::class,
        'destroy',
    ])->name('terms.restaurants.destroy');
});
