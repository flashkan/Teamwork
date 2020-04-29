<?php

namespace App;

use App\Rules\OneOpenLot;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Balance;

class Lot extends Model
{
    public static function rules()
    {
        $tableNameProduct = (new Product())->getTable();
        $tableNameUser = (new User())->getTable();
        return [
            'product_id' => ["required", "exists:{$tableNameProduct},id", new OneOpenLot()],
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

    public function bids()
    {
        return $this->hasMany(Bid::class, 'lot_id')->get();
    }

    public static function finish()
    {
        $openLots = self::query()->where('closed', '0')->get();
        foreach ($openLots as $lot) {
            if (now() > $lot->end_time) {
                $lot->closed = 1;

                if ($lot->save()) {
                    $message = "Lot $lot->id was closed";

                    if (isset($lot->current_buyer_id)) {
                        $product = $lot->product();
                        $product->transferOwnership($lot->current_buyer_id);

                        $sellerBalance = Balance::find($lot->seller_id);
                        $sellerBalance->increase($lot->current_rate);

                        $buyerBalance = Balance::find($lot->current_buyer_id);
                        $buyerBalance->decrease($lot->current_rate);
                    }
                } else {
                    $message = "Error (Lot $lot->id wasn't closed) in " . __FILE__ . ' line ' . __LINE__;
                }
                info($message); // storage/logs/laravel.log
            }
        }
    }

    public static function userBids($userId)
    {
        $allMyBids = Bid::query()
            ->where('user_id', $userId)
            ->get()
            ->pluck('lot_id')
            ->unique();
        return $bids = self::query()
            ->whereIn('id', $allMyBids->all())
            ->where('closed', '0')->get();
    }

    public static function userWonLots($userId)
    {
        return self::query()
            ->where([
                ['current_buyer_id', $userId],
                ['closed', 1]
            ])->get();
    }
}
