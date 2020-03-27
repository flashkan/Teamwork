<?php

use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('accounts')->insert($this->getData());
    }

    public function getData()
    {
        $data = [];
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();

        for($i = 1; $i <= $numOfUsers; $i++) {
            $data[] = [
                'user_id' => $faker->unique()->numberBetween(1, $numOfUsers),
                'balance' => $faker->randomFloat(2, -100, 100),
            ];
        }
        return $data;
    }
}
