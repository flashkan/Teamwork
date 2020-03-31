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

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'product_id' => $faker->numberBetween(1, 10),
                'seller_id' => $faker->numberBetween(1, 10),
                'start_price' => $faker->randomFloat(2, 1000, 5000),
                'buyback_price' => $faker->randomFloat(2, 50000, 100000),
                'end_time' => $faker->dateTimeBetween($startDate = '3 hour', $endDate = '5 days', $timezone = 'MSK'),
                'current_rate' => $faker->randomFloat(2, 5000, 50000),
                'current_buyer_id' => $faker->numberBetween(1, 10),
            ];
        }
        return $data;
    }
}
