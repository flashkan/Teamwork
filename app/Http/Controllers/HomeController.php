<?php

namespace App\Http\Controllers;

use App\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $openLots = Lot::query()->where('closed', 0)->get();

        $lotsFirst = $openLots->random(3);
        $lotsSecond = $openLots
            ->whereNotInStrict('id', $lotsFirst->pluck('id'))
            ->random(3);

        return view('home', [
            'lotsFirst' => $lotsFirst,
            'lotsSecond' => $lotsSecond,
        ]);
    }
}
