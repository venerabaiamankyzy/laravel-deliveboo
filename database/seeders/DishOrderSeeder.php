<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Support\Arr;
use Carbon\Carbon;
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
        $orders = Order::all();

        foreach ($orders as $order) {
            $restaurantId = $order->restaurant_id;
            $dishes = Dish::where('restaurant_id', $restaurantId)->get();

            $dishesWithQuantities = Arr::random($dishes->toArray(), random_int(1, 5));

            $totalAmount = 0;

            foreach ($dishesWithQuantities as $dish) {
                $quantity = $faker->numberBetween(2, 5);
                $totalAmount += $dish['price'] * $quantity;

                $order->dishes()->attach($dish['id'], [
                    'quantity' => $quantity
                ]);
            }

            $order->total_amount = $totalAmount;

            // Imposta created_at con un mese casuale da febbraio a maggio
            $randomMonth = $faker->numberBetween(2, 5);
            $customCreatedAt = Carbon::create(null, $randomMonth, null, 0, 0, 0);
            $order->created_at = $customCreatedAt;

            $order->save();
        }
    }
}
