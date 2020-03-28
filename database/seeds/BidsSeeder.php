<?php

use Illuminate\Database\Seeder;
use App\User;

class BidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('bids')->insert($this->getData());
    }

    public function getData()
    {
        $data = collect();
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();
        $numOfLots = App\Lot::count();

        for($i = 1; $i <= $numOfLots * 5; $i++) {
            $userId = $faker->numberBetween(1, $numOfUsers);
            $userLots = User::find($userId)->userLots();

            do {
                $lotId = $faker->numberBetween(1, $numOfLots);
            } while (!$userLots->whereStrict('id', $lotId));

            $amount = $faker->randomFloat(2, 0, 100);

            do {
                $createdAt = $faker->dateTimeBetween($startDate = '-5 days', $endDate = '-1 hour', $timezone = 'MSK');
            } while (!$this->checkAmountAndTime($data, $amount, $lotId, $createdAt));

            $data->push([
                'user_id' => $userId,
                'lot_id' => $lotId,
                'amount' => $amount,
                'created_at' => $createdAt,
            ]);
        }
        return $data->toArray();
    }

    public function checkAmountAndTime($data, $amount, $lotId, $createdAt)
    {
        foreach ($data as $row) {
            if ($row['lot_id'] === $lotId && $row['amount'] > $amount && $row['created_at'] < $createdAt) {
                return false;
            }
        }
        return true;
    }
}
