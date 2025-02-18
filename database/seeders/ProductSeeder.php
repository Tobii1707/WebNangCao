<?php

// database/seeders/ProductSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word(),
                'description' => $faker->sentence(),
                'price' => $faker->randomFloat(2, 10, 100),
                'quantity' => $faker->numberBetween(1, 50),
                'image' => 'default.png', // Cột 'image' cần có giá trị mặc định
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
