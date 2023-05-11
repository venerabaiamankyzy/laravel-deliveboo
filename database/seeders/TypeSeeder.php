<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types_list = ['Italiano', 'Americano', 'Cinese', 'Giapponese', 'Messicano', 'Indiano', 'Pesce', 'Carne', 'Pizza', 'Sushi', 'Vegana'];

        foreach ($types_list as $type) {
            $new_type = new Type;
            $new_type->name = $type;
            // $new_type->icon = '';
            $new_type->save();
        }
        
    }
}
