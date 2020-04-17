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
        $bidsData = $this->getBidsData();
        \Illuminate\Support\Facades\DB::table('bids')->insert($bidsData);

        $lotsData = $this->getLotsData($bidsData);
        $lotsData->each(function ($item, $key) {
            \Illuminate\Support\Facades\DB::table('lots')->where('id', '=', $item['id'])->update([
                'current_rate' => $item['current_rate'],
                'current_buyer_id' => $item['current_buyer_id']
            ]);
        });
    }

    public function getBidsData()
    {
        $data = collect();
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();
        $numOfLots = App\Lot::count();

        for($i = 1; $i <= $numOfLots * 5; $i++) {
            $userId = $faker->numberBetween(1, $numOfUsers);
            $userLots = User::find($userId)->seller();

            do {
                $lotId = $faker->numberBetween(1, $numOfLots);
            } while ($userLots->containsStrict('id', $lotId));

            $currentLot = App\Lot::find($lotId);
            $amount = $faker->randomFloat(2, $currentLot['start_price'], $currentLot['start_price'] + 100);
            $filteredData = $data->filter(function ($value, $key) use ($lotId) {
                return $value['lot_id'] === $lotId;
            });

            do {
                $createdAt = $faker->dateTimeBetween($startDate = '-5 days', $endDate = '-1 hour', $timezone = 'MSK');
            } while (!$this->checkAmountAndTime($filteredData, $amount, $createdAt));

            $data->push([
                'user_id' => $userId,
                'lot_id' => $lotId,
                'amount' => $amount,
                'created_at' => $createdAt,
            ]);
        }
        return $data->toArray();
    }

    public function checkAmountAndTime($data, $amount, $createdAt)
    {
        foreach ($data as $row) {
            if (($row['amount'] > $amount && $row['created_at'] < $createdAt) ||
                ($row['amount'] < $amount && $row['created_at'] > $createdAt)) {
                return false;
            }
        }
        return true;
    }

    public function getLotsData($bidsData)
    {
        $data = collect();
        $faker = \Faker\Factory::create('ru_RU');
        $numOfLots = App\Lot::count();

        for($i = 1; $i <= $numOfLots; $i++) {
            $filteredBids = collect($bidsData)->filter(function ($value, $key) use ($i) {
                return $value['lot_id'] === $i;
            });
            $currentRate = $filteredBids->isEmpty() ? 0 : $filteredBids->max('amount');
            $currentBuyerId = $filteredBids->sortByDesc('amount')->first()['user_id'];

            $data->push([
                'id' => $i,
                'current_rate' => $currentRate,
                'current_buyer_id' => $currentBuyerId,
            ]);
        }
        return $data;
    }
}
