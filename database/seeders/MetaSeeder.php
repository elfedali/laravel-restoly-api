<?php

namespace Database\Seeders;

use App\Models\Meta;
use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meta::factory()
            ->count(5)
            ->create();
    }
}
