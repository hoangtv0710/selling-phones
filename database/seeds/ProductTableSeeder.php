<?php

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('products')->insert([
            	'name' => $faker->name(),
                'image' => 'example.png',
                'description' => $faker->paragraph,
                'quantity' => 100,
                'price' => rand(1000000, 2000000),
                'promotional' => 0,
            	'cate_id' => ProductType::all()->random()->cate_id,
            	'productType_id' => ProductType::all()->random()->id,
                'status' => 1,
            ]);
        }
    }
}
