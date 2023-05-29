<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = FakerFactory::create('it_IT');

        $restaurants = Restaurant::all()->pluck('id')->toArray();

        foreach ($restaurants as $restaurant) {
            for($i = 0; $i < random_int(40, 100); $i++) {
                $order = new Order;
                $order->restaurant_id = $restaurant;
                $order->customer_name = $faker->firstNameMale();
                $order->customer_surname = $faker->lastName();
                $order->customer_mail = $faker->safeEmail();
                $order->customer_phone_number = $faker->numberBetween(3000000000, 3999999999);
                $order->customer_address = $faker->streetAddress();
                $order->total_amount = $faker->randomFloat(2, 20, 100);
                $order->status = $faker->boolean();
                $order->save();
            }
        }
    }
}
