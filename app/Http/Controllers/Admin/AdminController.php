<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lot;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /******************************Users******************************/
    public function userAll()
    {
        return view('admin.user.all', ['users' => User::paginate(10)]);
    }

    public function userOne(User $user)
    {
        return view('admin.user.one', ['user' => $user]);
    }

    public function userAdd(Request $request)
    {
        $user = new User();
        if ($request->isMethod('post')) {
            $this->validate($request, User::rules());
            $user->fill($request->all());
            $user->save();
            return redirect()
                ->route('admin.user.one', ['user' => $user])
                ->with('success', 'User successfully created');
        }
        return view('admin.user.add', ['user' => $user]);
    }

    public function userUpdate(Request $request, User $user)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, User::rules());

            if ($request->update_password) {
                $user->fill($request->all());
            } else {
                $user->fill($request->except('password'));
            }

            $user->save();
            return redirect()
                ->route('admin.user.one', ['user' => $user])
                ->with('success', 'User successfully update');
        }
        return view('admin.user.add', ['user' => $user, 'isUpdate' => true]);
    }

    public function userDelete(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()
                ->back()
                ->with('failure', 'You can\'t delete yourself.');
        }

        $user->delete();
        return redirect()
            ->route('admin.user.all')
            ->with('success', 'User successfully deleted');
    }

    /******************************Products******************************/
    public function productAll()
    {
        return view('admin.product.all', ['products' => Product::paginate(8)]);
    }

    public function productOne(Product $product)
    {
        return view('admin.product.one', ['product' => $product]);
    }

    public function productAdd(Request $request)
    {
        $product = new Product();
        if ($request->isMethod('post')) {
            $this->validate($request, Product::rules());
            if ($request->img) $product->addImage($request);
            $product->fill($request->all());
            $product->save();
            return redirect()
                ->route('admin.product.one', ['product' => $product])
                ->with('success', 'Product successfully created');
        }
        return view('admin.product.add', ['product' => $product, 'users' => User::all()]);
    }

    public function productUpdate(Request $request, Product $product)
    {
        if ($request->isMethod('post')) {
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
                ->route('admin.product.one', ['product' => $product])
                ->with('success', 'Product successfully updated');
        }
        return view('admin.product.add', ['product' => $product, 'users' => User::all()]);
    }

    public function productDelete(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('admin.product.all')
            ->with('success', 'Product successfully deleted');
    }

    /******************************Lots******************************/
    public function lotAll()
    {
        return view('admin.lot.all', ['lots' => Lot::paginate(9)]);
    }

    public function lotOne(Lot $lot)
    {
        return view('admin.lot.one', [
            'lot' => $lot,
            'product' => $lot->product(),
            'bids' => $lot->bids()->sortByDesc('created_at'),]);
    }

    public function lotAdd(Request $request)
    {
        $lot = new Lot();
        if ($request->isMethod('post')) {
            $request->merge(['end_time' => date('Y-m-d\TH:i', strtotime($request->end_time))]);
            $this->validate($request, Lot::rules());
            $lot->fill($request->all());
            $lot->save();
            return redirect()
                ->route('admin.lot.one', ['lot' => $lot])
                ->with('success', 'Lot successfully created');
        }
        return view('admin.lot.add', ['lot' => $lot, 'products' => Product::all(), 'users' => User::all()]);
    }

    public function lotUpdate(Request $request, Lot $lot)
    {
        if ($request->isMethod('post')) {
            $request->merge(['end_time' => date('Y-m-d\TH:i', strtotime($request->end_time))]);
            $this->validate($request, Lot::rules());
            $lot->fill($request->all());
            $lot->save();
            return redirect()
                ->route('admin.lot.one', ['lot' => $lot])
                ->with('success', 'Lot successfully updated');
        }
        $lot->end_time = date('Y-m-d\TH:i', strtotime($lot->end_time));
        return view('admin.lot.add', ['lot' => $lot,'products' => Product::all(), 'users' => User::all()]);
    }

    public function lotDelete(Lot $lot)
    {
        $lot->delete();
        return redirect()
            ->route('admin.lot.all')
            ->with('success', 'Lot successfully deleted');
    }
}
