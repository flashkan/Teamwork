<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Http\Request;

>>>>>>> master
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
<<<<<<< HEAD
//        $this->middleware('auth');
=======
        $this->middleware('auth');
>>>>>>> master
    }

    /**
     * Show the application dashboard.
<<<<<<< HEAD
=======
     *
     * @return \Illuminate\Contracts\Support\Renderable
>>>>>>> master
     */
    public function index()
    {
        return view('home');
    }
}
