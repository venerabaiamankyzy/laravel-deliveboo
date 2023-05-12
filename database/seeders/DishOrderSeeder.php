<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $dishes = Dish::all()->pluck('id')->toArray();
        $orders = Order::all();

        foreach ($orders as $order) {
            $order->dishes()->attach($faker->randomElements($dishes, random_int(0, 10)));
        }
    }
}
