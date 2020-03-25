<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Lot extends Model
{
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
