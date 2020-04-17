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
        $data = collect();
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();
        $products = App\Product::all();
        $numOfProducts = $products->count();

        for ($i = 1; $i <= $numOfProducts * 0.5; $i++) {
            do {
                $sellerId = $faker->numberBetween(1, $numOfUsers);
            
                $filteredProducts = $products->filter(function ($value, $key) use ($sellerId) {
                    return $value['owner_id'] === $sellerId;
                });
            } while ($filteredProducts->isEmpty());

            $productId = $filteredProducts->random()['id'];
            
            $data->push([
                'product_id' => $productId,
                'seller_id' => $sellerId,
                'start_price' => $faker->randomFloat(2, 1000, 5000),
                'buyback_price' => $faker->randomFloat(2, 50000, 100000),
                'end_time' => $faker->dateTimeBetween($startDate = '3 hour', $endDate = '5 days', $timezone = 'MSK'),
                'closed' => 0,
            ]);
        }
        return $data->toArray();
    }
}
