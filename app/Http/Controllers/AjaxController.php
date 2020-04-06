<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) {
            return $request;
//            return User::all()->first();
        }
    }
}
