<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'balance',
    ];
    
    public function getAuthedUserAccount()
    {
        return self::query()->where('user_id', '=', Auth::id())->first();
    }
}
