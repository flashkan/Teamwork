<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function my()
    {
        if (Auth::check()) {
            $userBalance = Auth::user()->balance();
            return view('balance.my', ['balance' => $userBalance]);
        }
    }

    public function increase(Request $request)
    {
        $userBalance = Auth::user()->balance();
        $userBalance->main_balance += $request->increase_balance;
        $saved = $userBalance->save();

        if ($saved) {
            return redirect()
                ->route('balance.my', ['balance' => $userBalance])
                ->with('success', "Plus $request->increase_balance on your balance");
        }
    }

    public function decrease(Request $request)
    {
        $userBalance = Auth::user()->balance();
        $userBalance->main_balance -= $request->decrease_balance;
        $saved = $userBalance->save();

        if ($saved) {
            return redirect()
                ->route('balance.my', ['balance' => $userBalance])
                ->with('success', "Minus $request->decrease_balance on your balance");
        }
    }
}
