<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('products')->insert($this->getData());
    }

    public function getData()
    {
        $data = [];
        $faker = \Faker\Factory::create('ru_RU');

        for($i = 1; $i <= 10; $i++) {
            $data[] = [
                'name' => $faker->realText(rand(10, 15)),
                'description' => $faker->realText(rand(20, 40)),
                'owner_id' => $faker->numberBetween(1, 5),
            ];
        }
        return $data;
    }
}
