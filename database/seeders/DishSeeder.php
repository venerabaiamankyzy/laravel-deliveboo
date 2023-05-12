<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $dish = new Dish;
            $dish->restaurant_id = $faker->numberBetween(1, 20);
            $dish->name = $faker->words(2, true);
            $dish->description = $faker->paragraph();
            $dish->price = $faker->randomFloat(2, 0, 100);
            $dish->photo = 'https://picsum.photos/200/200';
            $dish->is_visible = $faker->boolean();
            $dish->save();
        }
    }
}
