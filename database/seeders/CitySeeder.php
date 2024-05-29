<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $country = new \App\Models\Country();
        $country->title = 'Morocco';
        $country->slug = 'country-morocco';
        $country->save();

        $cities = [
            [
                'name' => 'Casablanca',
                'streets' => [
                    'Ain Diab',
                    'Belvedere',
                    'Ain Sebaâ',
                    'Anfa',
                    'Al Qods'
                ]
            ],
            [
                'name' => 'Fez',
                'streets' => [
                    'Al Qods',
                    'Médina',
                    'Dhar El Mehraz',
                    'Saiss'
                ]
            ],
            [
                'name' => 'Kénitra',
                'streets' => [
                    'Médina',
                    'Hassan II',
                    'El Walili',
                    'Bir Rami'
                ]
            ],
            [
                'name' => 'Marrakech',
                'streets' => [
                    'Gueliz',
                    'Médina',
                    'Hivernage',
                    'Agdal'
                ]
            ],

        ];

        foreach ($cities as $cityData) {
            $city = City::create([
                'title' => $cityData['name'],
                'country_id' => $country->id
            ]);

            foreach ($cityData['streets'] as $streetName) {
                Neighborhood::create([
                    'title' => $streetName,
                    'city_id' => $city->id
                ]);
            }
        }
    }
}
