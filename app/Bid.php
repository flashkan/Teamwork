<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
