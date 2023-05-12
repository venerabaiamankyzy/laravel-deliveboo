<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = Restaurant::all();
        $types = Type::all()->pluck('id')->toArray();

        foreach ($restaurants as $restaurant) {
            $restaurant->types()->attach($faker->randomElements($types, random_int(0, 3)));
        }
    }
}
