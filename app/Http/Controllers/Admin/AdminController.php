<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lot;
use App\Product;
use App\User;

class AdminController extends Controller
{
    public function users()
    {
        return view('admin.users', ['users' => User::paginate(10)]);
    }

    public function products()
    {
        return view('admin.products', ['products' => Product::paginate(8)]);
    }
//
    public function lots()
    {
        return view('admin.lots', ['lots' => Lot::paginate(9)]);
    }


}
