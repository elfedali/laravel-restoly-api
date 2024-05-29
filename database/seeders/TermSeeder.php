<?php

namespace Database\Seeders;

use App\Models\Taxonomy;
use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceTerms = [
            'Surplace',
            'Livraison',
            'Emporter',
        ];

        $kitchenTermFr = [
            'Méditerranéenne',
            'Marocaine',
            'Asiatique',
            'Italienne',
            'Française',
            'Espagnole',
            'Américaine',
            'Mexicaine',

        ];
        // create the taxonomy terms
        $tax_1 = Taxonomy::create([
            "title" => "Restaurant",
            "slug" => "taxonomy-restaurant",
        ]);

        $tax_2 = Taxonomy::create([
            "title" => "Cuisine",
            "slug" => "taxonomy-cuisine",
        ]);


        foreach ($serviceTerms as $term) {
            \App\Models\Term::factory()->create([
                'title' => $term,
                'taxonomy_id' => $tax_1->id,
            ]);
        }

        foreach ($kitchenTermFr as $term) {
            \App\Models\Term::factory()->create([
                'title' => $term,
                'taxonomy_id' => $tax_2->id,
            ]);
        }
    }
}
