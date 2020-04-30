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
        $bidsLot = Lot::find($request->input('lot_id'));


        $errors = $this->validateBids($request, $bidsLot);
        if ($errors) return $errors;

        $newBid = Bid::newBid($request, Auth::id());

        $bidsLot->current_rate = $request->input('amount');
        $bidsLot->current_buyer_id = Auth::id();

        if ($bidsLot->current_rate >= $bidsLot->buyout_price && isset($bidsLot->buyout_price)) {
            $bidsLot->end_time = now();
        }

        return $this->finishCheckBid($bidsLot->update(), $newBid->save());
    }

    private function validateBids(Request $request, $bidsLot)
    {
        if ((int)$bidsLot->seller_id === (int)Auth::id()) {
            return redirect()
                ->back()
                ->with('failure', 'Seller can\'t bid');
        }

        $highestBid = Bid::where('lot_id', $request->input('lot_id'))
            ->orderBy('amount', 'desc')
            ->limit(1)
            ->first();

        if (isset($highestBid)) {
            if ($highestBid->amount >= $request->input('amount')) {
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
    }

    private function finishCheckBid($updated, $saved)
    {
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

    public function delete(Request $request)
    {
        $errors = Bid::deleteBid($request);
        if ($errors) return $errors;

        $lot = Lot::find($request->lot_id);
        $highestBid = $lot->bids()->sortBy('amount')->last();

        if (isset($highestBid)) {
            $lot->current_rate = $highestBid->amount;
            $lot->current_buyer_id = $highestBid->user_id;
        } else {
            $lot->current_rate = 0;
            $lot->current_buyer_id = null;
        }

        $lot->update();

        return redirect()
            ->back()
            ->with('success', 'Bid successfully deleted');
    }
}
