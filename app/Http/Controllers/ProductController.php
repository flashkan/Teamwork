<?php

namespace App\Http\Controllers;

use App\Lot;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function all()
    {
        return view('products.all', ['products' => Product::all()]);
    }

    public function my()
    {
        return view('products.my', ['products' => Auth::user()->unsoldProducts()]);
    }

    public function one(Product $product)
    {
        return view('products.one', ['product' => $product]);
    }

    public function add(Request $request)
    {
        $product = new Product();
        if ($request->isMethod('post')) {
            $request->merge(['owner_id' => Auth::id()]); // Добавляем авторизованного пользователя.
            $this->validate($request, Product::rules());
            $product->fill($request->all());
            $product->save();
            return redirect()
                ->route('product.one', ['product' => $product])
                ->with('success', 'Product successfully created');
        }
        return view('products.add', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        if ($request->isMethod('post')) {
            $request->merge(['owner_id' => $product->owner_id]);
            $this->validate($request, Product::rules());
            $product->fill($request->all());
            $product->save();
            return redirect()
                ->route('product.one', ['product' => $product])
                ->with('success', 'Product successfully updated');
        }
        return view('products.add', ['product' => $product]);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('product.my')
            ->with('success', 'Product successfully deleted');
    }
}
