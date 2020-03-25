<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lot;

class LotController extends Controller
{
    public function all()
    {
        return view('lots.all', ['lots' => Lot::all()]);
    }

    public function one(Lot $lot)
    {
        return view('lots.one', ['lot' => $lot]);
    }

    public function my()
    {
        $myLots = (new Lot)->userLots();

        return view('lots.my', ['lots' => $myLots]);
    }
}
