<?php

namespace App\Http\Middleware;

use App\Lot;
use Closure;

class ClosedLot
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pattern = "/(?<=\/lot\/[one]|[update]|[delete]\/)\d+/";
        preg_match($pattern, $request->getRequestUri(), $lotId);
        if (Lot::find($lotId[0])->closed) return back();
        return $next($request);
    }
}
