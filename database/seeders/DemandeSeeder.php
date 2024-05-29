<?php

namespace Database\Seeders;

use App\Models\Demande;
use Illuminate\Database\Seeder;

class DemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Demande::factory()
            ->count(5)
            ->create();
    }
}
