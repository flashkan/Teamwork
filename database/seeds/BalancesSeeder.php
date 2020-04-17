<?php

use Illuminate\Database\Seeder;

class BalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('balances')->insert($this->getData());
    }

    public function getData()
    {
        $data = [];
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();

        for($i = 1; $i <= $numOfUsers; $i++) {
            $data[] = [
                'user_id' => $i,
                'main_balance' => $faker->randomFloat(2, -100, 100),
            ];
        }
        return $data;
    }
}
