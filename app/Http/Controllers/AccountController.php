<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
//        dd($user->seller());
        return view('account', ['user' => $user,
            'products' => $user->products(),
            'lots' => $user->seller(),
            'bids' => $user->buyer(),
            'balance' => $user->balance()]);
    }

    public function updatePass(Request $request)
    {
        if ($request->isMethod('put')) {
            if (User::checkPass($request->password)) {
                return 'true';
            }
            return 'false';
        } elseif ($request->isMethod('post')) {
            $user = Auth::user();
            $this->validate($request, User::rulesForUpdatePass());
            $request->merge(['password' => Hash::make($request->password)]);
            $user->fill($request->all());

            if ($user->update()) {
                session()->flash('success', 'Your password has been updated.');
                return 'true';
            } else return 'false';
        }
    }
}
