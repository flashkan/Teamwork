<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(BalancesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(LotsSeeder::class);
        $this->call(BidsSeeder::class);
    }
}
