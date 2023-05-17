<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('password');
        $user->save();

        for ($i=0; $i < 15; $i++) { 
            $new_user = new User;
            $new_user->name = $faker->firstNameMale();
            $new_user->email = $faker->safeEmail();
            $new_user->password = bcrypt('password');
            $new_user->save();
        }
    }
}
