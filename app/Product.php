<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    public function userProducts()
    {
        return self::query()->where('owner_id', '=', Auth::id())->get();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->first();
    }
}
