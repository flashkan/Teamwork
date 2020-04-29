<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    protected $dataForSeeder = [
        ['Chair', 'Chair description', 'https://upload.wikimedia.org/wikipedia/commons/c/c6/Set_of_fourteen_side_chairs_MET_DP110780.jpg'],
        ['Table', 'Table description', 'https://upload.wikimedia.org/wikipedia/commons/e/ed/Writing_table_%28bureau_plat%29_MET_DP105403.jpg'],
        ['Car', 'Car description', 'https://upload.wikimedia.org/wikipedia/commons/2/21/Smart_Fortwo_passion_front.JPG'],
        ['Bike', 'Bike description', 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Norton_Motorcycle.jpg'],
        ['Sofa', 'Sofa description', 'https://upload.wikimedia.org/wikipedia/commons/3/33/Loriots_Sofa.JPG'],
        ['PC', 'PC description', 'https://upload.wikimedia.org/wikipedia/commons/b/b6/Desktop_personal_computer.jpg'],
        ['Macbook', 'Macbook description', 'https://upload.wikimedia.org/wikipedia/commons/2/2a/MacBook_Air_1b.jpg'],
        ['iPhone', 'iPhone description', 'https://upload.wikimedia.org/wikipedia/commons/3/3b/IPhone_5s_top.jpg'],
        ['Bicycle', 'Bicycle description', 'https://upload.wikimedia.org/wikipedia/commons/4/41/Left_side_of_Flying_Pigeon.jpg'],
        ['Pie', 'Pie description', 'https://upload.wikimedia.org/wikipedia/commons/9/91/Tarte_aux_poires_2a.jpg'],
        ['Sandwich', 'Sandwich description', 'https://upload.wikimedia.org/wikipedia/commons/e/e6/BLT_sandwich_on_toast.jpg'],
        ['Pillow', 'Pillow description', 'https://upload.wikimedia.org/wikipedia/en/8/84/Average_White_Pillow.jpg'],
        ['House', 'House description', 'https://upload.wikimedia.org/wikipedia/commons/d/d2/Strada_Matei_Basarab_nr._50_%28B-II-m-B-18083%29.JPG'],
        ['Knife', 'Knife description', 'https://upload.wikimedia.org/wikipedia/commons/3/33/Damascus_Bowie.jpg'],
        ['Pet', 'Pet description', 'https://upload.wikimedia.org/wikipedia/commons/9/93/Pet-rebbit-on-Swing_%28seat%29-in-beijing.jpg'],
        ['Plant', 'Plant description', 'https://upload.wikimedia.org/wikipedia/commons/9/91/Snake_plant.jpg'],
        ['Socks', 'Socks description', 'https://upload.wikimedia.org/wikipedia/commons/c/cf/Argyle_%28PSF%29.png'],
        ['Laptop', 'Laptop description', 'https://upload.wikimedia.org/wikipedia/commons/4/42/Alienware.JPG'],
        ['PHPStorm key', 'PHPStorm key description', 'https://upload.wikimedia.org/wikipedia/commons/d/d0/Phpstorm.png'],
        ['Doll', 'Doll description', 'https://upload.wikimedia.org/wikipedia/commons/d/d2/Russian-Matroshka_no_bg.jpg'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('products')
            ->insert($this->getData());
        // $this->addImages();
    }

    public function getData()
    {
        $data = [];
        $faker = \Faker\Factory::create('ru_RU');
        $numOfUsers = App\User::count();

        for($i = 1; $i <= $numOfUsers * 2; $i++) {
            $data[] = [
                //'name' => $faker->realText(rand(10, 15)),
                //'description' => $faker->realText(rand(20, 40)),
                'name' => $this->dataForSeeder[$i - 1][0],
                'description' => $this->dataForSeeder[$i - 1][1],
                'owner_id' => $faker->numberBetween(1, $numOfUsers),
            ];
        }
        return $data;
    }

    public function addImages()
    {
        $i = 0;
        Product::all()->each(function ($item) use ($i) {
            dump($this->dataForSeeder[$i][2]);
            $item->addImageWithLink($this->dataForSeeder[$i][2]);
            $i++;
        });
    }
}
