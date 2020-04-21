<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Balance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'main_balance',
    ];

    public function increase($amount) {
        $this->main_balance += $amount;
        return $this->update();
    }

    public function decrease($amount) {
        $this->main_balance -= $amount;
        return $this->update();
    }
}
