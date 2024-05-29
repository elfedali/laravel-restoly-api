<?php

namespace Database\Seeders;

use App\Models\Ping;
use Illuminate\Database\Seeder;

class PingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ping::factory()
            ->count(5)
            ->create();
    }
}
