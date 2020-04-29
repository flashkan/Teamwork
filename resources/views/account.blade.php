@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            Hello, {{ $user->name }}, it is your personal account.
        </h3>
        <p><b>Your name:</b> {{ $user->name }}</p>
        <p><b>Your email:</b> {{ $user->email }}</p>
        <div>
            <h3>Your products</h3>
            <a class="btn btn-success mb-2" href="{{ route('product.add') }}">Add new</a>
            <div class="row m-1">
                @forelse ($products as $product)
                    <div class="card col-3 p-1" style="width: 18rem;">
                        <img class="card-img p-0 my-2" src="{{ $product->img_url ? Storage::url($product->img_url)
                        : Storage::url('placeholder.jpg') }}" alt="img_product">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Name product:</strong> {{ $product->name }}</h5>
                            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        </div>
                        <a class="btn btn-primary" href="{{route('product.one', $product)}}">More</a>
                    </div>
                @empty
                    <h2 class="text-center col-12">You don't have products in your account</h2>
                @endforelse
            </div>
        </div>
        <div class="my-4">
            <h3>Your lots</h3>
            <a class="btn btn-success mb-2" href="{{ route('lot.add') }}">Add new</a>
            <div class="row m-1">
                @forelse ($lots as $lot)
                    <div class="card col-4 p-1" style="width: 18rem;">
                        <div class="card-body">
                            <img class="card-img p-0 my-2" src="{{ $lot->product()->img_url
? Storage::url($lot->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                            <h4 class="card-text"><strong>Product:</strong> {{ $lot->product()->name }}</h4>
                            <h5 class="card-title"><strong>Start price:</strong> {{ $lot->start_price }}</h5>
                            @if(isset($lot->buyback_price))
                                <p class="card-title"><strong>Buyback price:</strong> {{ $lot->buyback_price }}</p>
                            @endif
                        </div>
                        <lots-timer-component :lot="{{$lot}}"
                                              :url="'{{ route('lot.one', $lot) }}'"></lots-timer-component>
                    </div>
                @empty
                    <h2 class="text-center col-12">You don't have lot for your products</h2>
                @endforelse
            </div>
        </div>
        <div class="my-4">
            <h3>Your bids</h3>
            <a class="btn btn-success mb-2" href="{{ route('lot.all') }}">Add new</a>
            <div class="row m-1">
                @forelse ($bids as $bid)
                    <div class="card col-4 p-1" style="width: 18rem;">
                        <div class="card-body">
                            <img class="card-img p-0 my-2" src="{{ $bid->product()->img_url
? Storage::url($bid->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                            <h4 class="card-text"><strong>Product:</strong> {{ $bid->product()->name }}</h4>
                            <h5 class="card-title"><strong>Start price:</strong> {{ $bid->start_price }}</h5>
                            @if(isset($bid->buyback_price))
                                <p class="card-title"><strong>Buyback price:</strong> {{ $bid->buyback_price }}</p>
                            @endif
                            <h3>Your bid: {{ $bid->current_rate }}</h3>
                        </div>
                        <lots-timer-component :lot="{{$bid}}" :user_id="{{ $user->id }}"
                                              :url="'{{ route('lot.one', $bid) }}'"></lots-timer-component>
                    </div>
                @empty
                    <h2 class="text-center col-12">You don't have bids</h2>
                @endforelse
            </div>
        </div>
        <div class="my-4">
            <h3>Your balance {{ $balance->main_balance }}</h3>
            <form method="post" action="{{ action('BalanceController@increase') }}">
                @csrf
                <div class="input-group my-3">
                    <input name="increase_balance" type="number" class="form-control col-2" id="increase_balance"
                           placeholder="How much" style="width:200px">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Increase</button>
                    </div>
                </div>
            </form>
            <form method="post" action="{{ action('BalanceController@decrease') }}">
                @csrf
                <div class="input-group">
                    <input name="decrease_balance" type="number" class="form-control col-2" id="decrease_balance"
                           placeholder="How much" style="width:200px">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Decrease</button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <h3>Change password</h3>
            <check-pass-component :url="'{{ route('account.update-pass') }}'" :csrf="'{{ csrf_token() }}'">
            </check-pass-component>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div style="height: 20em"></div>
    </div>
@endsection
