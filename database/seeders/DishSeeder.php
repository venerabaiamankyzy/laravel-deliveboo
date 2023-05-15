<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Dish;
use App\Models\Restaurant;
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
        $restaurants = Restaurant::all()->pluck('id')->toArray();
        $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

        $results = [];
        $response = file_get_contents('https://pixabay.com/api/?key=36421115-17c585d164b97ca0858bcc2f4&q=piatto+cibo&image_type=photo&pretty=true&lang=it');
        $response = json_decode($response);
        $results = $response->hits;

        foreach ($restaurants as $restaurant) {
            for($i = 0; $i < random_int(5, 20); $i++) {
                $dish = new Dish;
                $dish->restaurant_id = $restaurant;
                $dish->name = $faker->foodName();
                $dish->description = $faker->meatName() . ', ' . $faker->vegetableName() . ', ' . $faker->sauceName();
                $dish->price = $faker->randomFloat(2, 0, 100);
                $dish->photo = $results[$i]->webformatURL;
                $dish->is_visible = $faker->boolean();
                $dish->save();
            }
        }
    }
}
