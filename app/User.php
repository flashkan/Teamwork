<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'owner_id')->get();
    }

    public function seller()
    {
        return $this->hasMany(Lot::class, 'seller_id')->get();
    }

    public function buyer()
    {
        return $this->hasMany(Lot::class, 'current_buyer_id')->get();
    }

    public function account()
    {
        return $this->hasOne(Account::class)->first();
    }

    public static function isAdmin()
    {
        if (Auth::user()->is_admin) return true;
    }
}
