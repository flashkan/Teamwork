<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Lot extends Model
{
    public static function rules()
    {
        $tableNameProduct = (new Product())->getTable();
        return [
            'product_id' => "required|exists:{$tableNameProduct},id",
            'price' => 'required|numeric',
            'end_time' => "required|date|after:now",
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'price', 'end_time',
    ];

    public function userLots()
    {
        $userProducts = (new Product)->userProducts();
        $userLots = [];
        foreach ($userProducts as $product) {
            $lot = $product->findOwnLot;
            if (isset($lot)) {
                $userLots[] = $lot;
            }
        }

        return $userLots;
    }

    public function parentProduct()
    {
        return $this->belongsTo(Product::class, 'product_id')->first();
    }
}
