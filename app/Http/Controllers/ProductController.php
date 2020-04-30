<?php

namespace App\Http\Controllers;

use App\Lot;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
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
            if ($request->img) $product->addImage($request);
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
        $errors = Product::checkOpenLot($product);
        if ($errors) return $errors;

        if ($request->isMethod('post')) {
            $request->merge(['owner_id' => $product->owner_id]);
            $this->validate($request, Product::rules());
            if ($request->img_del) {
                $product->deleteImage($request);
            } elseif ($request->img) {
                if ($product->img_url) $product->deleteImage($request);
                $product->addImage($request);
            }
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
        $errors = Product::checkOpenLot($product);
        if ($errors) return $errors;

        $product->is_delete = true;
        if ($product->update()) {
            return redirect()
                ->route('account.index')
                ->with('success', 'Product successfully deleted');
        }

        return redirect()
            ->route('account.index')
            ->with('failure', 'Something went wrong');
    }
}
