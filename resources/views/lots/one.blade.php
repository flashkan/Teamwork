@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-light" href="{{back()->getTargetUrl()}}">Back</a>
        <h5 class="card-title"><strong>Стартовая цена:</strong> {{ $lot->start_price }}</h5>
        @if(isset($lot->buyback_price))
            <h5 class="card-title"><strong>Цена выкупа:</strong> {{ $lot->buyback_price }}</h5>
        @endif
        <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
        <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->product()->name }}</p>
        <div class="col-5 p-0">
            <lot-timer-component :lot="{{$lot}}" :url="'{{ route('lot.all') }}'"></lot-timer-component>
        </div>
        @auth
            @if((int) $lot->seller_id === (int) \Illuminate\Support\Facades\Auth::id())
                <a class="btn btn-success" href="{{ route('lot.update', $lot) }}">Update</a>
                <a class="btn btn-danger" href="{{ route('lot.delete', $lot) }}">Delete</a>
            @endif
        @endauth

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
