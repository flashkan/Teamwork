@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <h5 class="card-title"><strong>Стартовая цена:</strong> {{ $lot->start_price }}</h5>
        @if(isset($lot->buyback_price))
            <h5 class="card-title"><strong>Цена выкупа:</strong> {{ $lot->buyback_price }}</h5>
        @endif
        <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
        <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->product()->name }}</p>
        <p class="card-text"><strong>Seller:</strong> {{ $lot->seller()->name }}</p>
        <p class="card-text"><strong>Seller Email:</strong> {{ $lot->seller()->email }}</p>
        <div class="col-5 p-0">
            <lots-timer-for-admin-component :lot="{{$lot}}"></lots-timer-for-admin-component>
        </div>
        <a class="btn btn-success" href="{{ route('admin.lot.update', $lot) }}">Update</a>
        <a class="btn btn-danger" href="{{ route('admin.lot.delete', $lot) }}">Delete</a>

        <h2>Bids</h2>
        <div class="containter w-25 p-3">
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
    </div>
@endsection
