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
        $bidsLot = Lot::find($lot_id);

        if ((int) $bidsLot->seller_id === (int) Auth::id()) {
            return redirect()
                ->back()
                ->with('failure', 'Seller can\'t bid');
        }

        $highestBid = Bid::where('lot_id', $lot_id)
            ->orderBy('amount', 'desc')
            ->limit(1)
            ->first();

        if (isset($highestBid)) {
            if ($highestBid->amount > $request->input('amount')) {
                return redirect()
                    ->back()
                    ->with('failure', 'Bid to low');
            }
        }

        if (empty($bidsLot->current_buyer_id) && $bidsLot->start_price > $request->input('amount')) {
            return redirect()
                    ->back()
                    ->with('failure', 'Bid can\'t be lower than starting price');
        }

        $newBid = new Bid();
        $request->merge(['user_id' => Auth::id()]);
        $newBid->fill($request->all());

        $bidsLot->current_rate = $request->input('amount');
        $bidsLot->current_buyer_id = Auth::id();

        $updated = $bidsLot->update();
        $saved = $newBid->save();
        if ($updated && $saved) {
            return redirect()
                ->back()
                ->with('success', 'Bid successfully created');
        } else {
            return redirect()
                ->back()
                ->with('failure', 'Something went wrong');
        }
    }
}
