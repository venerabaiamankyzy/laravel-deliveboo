<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
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
        $restaurants = Restaurant::all()->pluck('id')->toArray();

        foreach ($restaurants as $restaurant) {
            for($i = 0; $i < random_int(5, 10); $i++) {
                $order = new Order;
                $order->restaurant_id = $restaurant;
                $order->customer_name = $faker->firstNameMale();
                $order->customer_surname = $faker->firstNameFemale();
                $order->customer_mail = $faker->email();
                $order->customer_phone_number = $faker->numberBetween(3000000000, 3999999999);
                $order->customer_address = $faker->streetAddress();
                $order->total_amount = $faker->randomFloat(2, 0, 100);
                $order->status = $faker->boolean();
                $order->note = $faker->paragraph();
                $order->save();
            }
        }
    }
}
