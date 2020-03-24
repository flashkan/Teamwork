<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new Product;
        $myProducts = $productModel->userProducts();
        
        $params = [
            'products' => $myProducts,
        ];
        return view('products.my_products', $params);
    }
    
    public function all()
    {
        User::all();
    }
}
