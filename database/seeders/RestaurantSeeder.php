<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $restaurant = new Restaurant;
            $restaurant->user_id = '1';
            $restaurant->name = $faker->company();
            $restaurant->address = $faker->streetAddress();
            $restaurant->vat_number = $faker->numberBetween(10000000000, 99999999999);
            $restaurant->phone_number = '3746578985';
            $restaurant->description = $faker->paragraph();
            $restaurant->photo = 'https://picsum.photos/500/300';
            $restaurant->save();
        }
    }
}
