<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function increase(Request $request)
    {
        $userBalance = Auth::user()->balance();
        $updated = $userBalance->increase($request->increase_balance);

        if ($updated) {
            return redirect()
                ->route('account.index', ['balance' => $userBalance])
                ->with('success', "Plus $request->increase_balance on your balance");
        }
    }

    public function decrease(Request $request)
    {
        $userBalance = Auth::user()->balance();
        $updated = $userBalance->decrease($request->decrease_balance);

        if ($updated) {
            return redirect()
                ->route('account.index', ['balance' => $userBalance])
                ->with('success', "Minus $request->decrease_balance on your balance");
        }
    }
}
