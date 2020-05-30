<?php

use Illuminate\Database\Seeder;
use App\Models\Category; 

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $limit = 3;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('product_types')->insert([
            	'cate_id' => Category::all()->random()->id,
                'name' => $faker->name(),
                'status' => 1,
            ]);
        }
    }
}
