<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function userProducts()
    {
        $loggedUserId = Auth::id();
        return parent::newQuery()->where('owner_id', '=', $loggedUserId)->get();
    }
}
