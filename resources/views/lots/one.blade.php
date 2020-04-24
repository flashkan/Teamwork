@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <div>
            <img class="card-img col-4 p-0 my-2" src="{{ $product->img_url ? Storage::url($product->img_url)
            : Storage::url('placeholder.jpg') }}" alt="img_product">
            <h3 class="card-text"><strong>Product:</strong> {{ $product->name }}</h3>
            <h5 class="card-text"><strong>Description:</strong> {{ $product->description }}</h5>
            <h5 class="card-title"><strong>Start price:</strong> {{ $lot->start_price }}</h5>
            @if(isset($lot->buyback_price))
                <p class="card-title"><strong>Buyback price:</strong> {{ $lot->buyback_price }}</p>
            @endif
            <p class="card-text"><strong>Seller:</strong> {{ $lot->seller()->name }}</p>
            <p class="card-text"><strong>End date:</strong> {{ $lot->end_time }}</p>
            <div class="col-5 p-0">
                <lot-timer-component :lot="{{$lot}}" :url="'{{ route('lot.all') }}'"></lot-timer-component>
            </div>
            @auth
                @if((int) $lot->seller_id === (int) \Illuminate\Support\Facades\Auth::id())
                    <div class="btn-group">
                        <a class="btn btn-success" href="{{ route('lot.update', $lot) }}">Update</a>
                        <a class="btn btn-danger" href="{{ route('lot.delete', $lot) }}">Delete</a>
                    </div>
                @endif
            @endauth
        </div>

        <h2>Bids</h2>
        <div class="w-25 p-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bids as $bid)
                    <tr>
                        <td>{{ $bid->user_id }}</td>
                        <td>{{ $bid->amount }}</td>
                        <td>{{ $bid->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @auth
            @if((int) $lot->seller_id !== (int) \Illuminate\Support\Facades\Auth::id())
                <h2>Make new bid</h2>
                <form method="post" action="{{ action('BidController@add') }}">
                    @csrf
                    <div class="form-group">
                        <label for="amount">Bid amount:</label>
                        <input name="amount" type="number" class="form-control" id="amount" placeholder="Enter number"
                               style="width:200px">
                        <input type="hidden" value="{{$lot->id}}" name="lot_id">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            @endif
        @endauth
    </div>
@endsection
