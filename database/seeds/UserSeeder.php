<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert($this->getData());
        factory(\App\User::class, 9)->create();
    }

    public function getData()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@email',
            'password' => \Illuminate\Support\Facades\Hash::make(123),
            'is_admin' => true,
        ];
    }
}
