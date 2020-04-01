<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Lot extends Model
{
    public static function rules()
    {
        $tableNameProduct = (new Product())->getTable();
        $tableNameUser = (new User())->getTable();
        return [
            'product_id' => "required|exists:{$tableNameProduct},id",
            'seller_id' => "required|exists:{$tableNameUser},id",
            'start_price' => 'required|numeric',
            'buyback_price' => 'numeric|nullable',
            'end_time' => "required|date|after:now",
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'seller_id', 'start_price', 'buyback_price', 'end_time',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->first();
    }

    public function seller()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function currentBuyer()
    {
        return $this->belongsTo(User::class)->first();
    }
}
