<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(ActivitySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(DemandeSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(MetaSeeder::class);
        $this->call(NeighborhoodSeeder::class);
        $this->call(PingSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(TaxonomySeeder::class);
        $this->call(TermSeeder::class);
        $this->call(UserSeeder::class);
    }
}
