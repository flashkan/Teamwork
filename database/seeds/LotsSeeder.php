<?php

use Illuminate\Database\Seeder;

class LotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('lots')->insert($this->getData());
    }

    public function getData()
    {
        $data = [];
        $faker = \Faker\Factory::create('ru_RU');

        for($i = 1; $i <= 20; $i++) {
            $data[] = [
                'product_id' => $faker->numberBetween(1, 10),
                'price' => $faker->randomFloat(2, 1000, 5000),
                'end_time' => date('Y-m-d H:i:s', time() + rand(1, 60) * rand(1, 60) * rand(10, 50)),
                'current_rate' => $faker->randomFloat(2, 5000, 50000),
                'current_buyer_id' => $faker->numberBetween(6, 10),
            ];
        }
        return $data;
    }
}
