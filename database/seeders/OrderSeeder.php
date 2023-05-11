<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Order;
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
        for($i = 0; $i < 20; $i++) {
            $order = new Order;
            $order->customer_name = $faker->firstNameMale();
            $order->customer_surname = $faker->firstNameFemale();
            $order->customer_mail = $faker->email();
            $order->customer_phone_number = '3746578985';
            $order->customer_address = $faker->streetAddress();
            $order->total_amount = $faker->randomFloat(2, 0, 100);
            $order->status = $faker->boolean();
            $order->note = $faker->paragraph();
            $order->save();
        }
    }
}
