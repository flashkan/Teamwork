<?php

namespace App\Http\Middleware;

use App\Lot;
use App\Product;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->getRequestUri();
        preg_match_all('/\w+/', $url, $response);
        $whereFrom = $response[0][0];
        $id = (int) $response[0][2];

        switch ($whereFrom) {
            case 'product':
                $ownerId = Product::query()->where('id', '=', $id)->first()->owner_id;
                if (Auth::id() === $ownerId) return $next($request);
                break;
            case 'lot':
                $sellerId = Lot::query()->where('id', '=', $id)->first()->seller_id;
                if (Auth::id() === $sellerId) return $next($request);
                break;
        }

        return redirect(route('home'));
    }
}
