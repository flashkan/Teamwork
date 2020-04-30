<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'lot_id', 'amount',
    ];

    public function bidder()
    {
        return $this->belongsTo(User::class, 'user_id')->first();
    }

    public static function newBid($request, $userId)
    {
        $newBid = new Bid();
        $request->merge(['user_id' => $userId]);
        return $newBid->fill($request->all());
    }

    public static function deleteBid(Request $request)
    {
        $delete = self::find($request->bid_id)->delete();
        if (!$delete) {
            return redirect()
                ->back()
                ->with('failure', 'Something went wrong');
        }
    }
}
