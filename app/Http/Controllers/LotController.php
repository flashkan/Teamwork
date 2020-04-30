<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lot;

class LotController extends Controller
{
    public function all()
    {
        if (Auth::check()) {
            $openLots = Lot::query()
                ->where('closed', 0)
                ->where('seller_id', '!=', Auth::id())
                ->paginate(9);
        } else {
            $openLots = Lot::query()
                ->where('closed', 0)
                ->paginate(9);
        }
                
        return view('lots.all', ['lots' => $openLots]);
    }

    public function one(Lot $lot)
    {
        return view('lots.one', [
            'lot' => $lot,
            'product' => $lot->product(),
            'bids' => $lot->bids()->sortByDesc('created_at')]);
    }

    public function add(Request $request)
    {
        $lot = new Lot();
        if ($request->isMethod('post')) {
            $request->merge(['end_time' => date('Y-m-d\TH:i', strtotime($request->end_time))]);
            $request->merge(['seller_id' => Auth::id()]);
            $this->validate($request, Lot::rules());
            $lot->fill($request->all());
            $lot->save();
            return redirect()
                ->route('lot.one', ['lot' => $lot])
                ->with('success', 'Lot successfully created');
        }
        return view('lots.add', [
            'lot' => $lot,
            'products' => Auth::user()->unsoldProducts()
        ]);
    }

    public function update(Request $request, Lot $lot)
    {
        if ($request->isMethod('post')) {
            $request->merge(['end_time' => date('Y-m-d\TH:i', strtotime($request->end_time))]);
            $request->merge(['seller_id' => Auth::id()]);
            $this->validate($request, Lot::rules());
            $lot->fill($request->all());
            $lot->save();
            return redirect()
                ->route('lot.one', ['lot' => $lot])
                ->with('success', 'Lot successfully updated');
        }
        $lot->end_time = date('Y-m-d\TH:i', strtotime($lot->end_time));
        return view('lots.add', [
            'lot' => $lot,
            'products' => Auth::user()->products()
        ]);
    }

    public function delete(Lot $lot)
    {
        $lot->delete();
        return redirect()
            ->route('lot.my')
            ->with('success', 'Lot successfully deleted');
    }
}
