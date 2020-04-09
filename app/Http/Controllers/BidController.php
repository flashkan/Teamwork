<?php

namespace App\Http\Controllers;

use App\Lot;
use Illuminate\Http\Request;
use App\Bid;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function add(Request $request)
    {
        $lot_id = $request->input('lot_id');
        if ((int) Lot::query()->whereId($lot_id)->first()->seller_id === (int) Auth::id()) {
            return redirect()
                ->back()
                ->with('success', 'Seller can\'t bid');
        }

        $highestBid = Bid::where('lot_id', $lot_id)
            ->orderBy('amount', 'desc')
            ->limit(1)
            ->first();

        if (isset($highestBid)) {
            if ($highestBid->amount > $request->input('amount')) {
                return redirect()
                    ->back()
                    ->with('success', 'Bid to low');
            }
        }

        $newBid = new Bid();
        $request->merge(['user_id' => Auth::id()]);
        $newBid->fill($request->all());
        $newBid->save();
        return redirect()
            ->back()
            ->with('success', 'Bid successfully created');
    }
}
