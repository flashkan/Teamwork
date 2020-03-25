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

        return view('products.my', ['products' => $myProducts]);
    }

    public function all()
    {
        return view('products.all', ['products' => Product::all()]);
    }

    public function one(Product $product)
    {
        return view('products.one', ['product' => $product]);
    }
}
