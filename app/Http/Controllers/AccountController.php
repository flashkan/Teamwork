<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function my()
    {
        if (Auth::check()) {
            $userAccount = (new Account)->getAuthedUserAccount();
            return view('accounts.my', ['account' => $userAccount]);
        }
    }

    public function increase(Request $request)
    {
        $userAccount = (new Account)->getAuthedUserAccount();
        $userAccount->balance += $request->increase_balance;
        $saved = $userAccount->save();

        if ($saved) {
            return redirect()
                ->route('account.my', ['account' => $userAccount])
                ->with('success', "Plus $request->increase_balance on your account");
        }
    }

    public function decrease(Request $request)
    {
        $userAccount = (new Account)->getAuthedUserAccount();
        $userAccount->balance -= $request->decrease_balance;
        $saved = $userAccount->save();

        if ($saved) {
            return redirect()
                ->route('account.my', ['account' => $userAccount])
                ->with('success', "Minus $request->decrease_balance on your account");
        }
    }
}
