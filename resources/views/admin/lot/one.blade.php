@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <div class="d-flex flex-column align-items-start">
            <img class="card-img col-4 p-0 my-2" src="{{ $product->img_url ? Storage::url($product->img_url)
            : Storage::url('placeholder.jpg') }}" alt="img_product">
            <a href="{{route('admin.product.one', ['product' => $product])}}" class="badge badge-light pl-0">
                <h3 class="card-text"><strong>Product:</strong> {{ $product->name }}</h3></a>
            <h5 class="card-text"><strong>Description:</strong> {{ $product->description }}</h5>
            <h5 class="card-title"><strong>Start price:</strong> {{ $lot->start_price }}</h5>
            @if(isset($lot->buyout_price))
                <p class="card-title"><strong>Buyout price:</strong> {{ $lot->buyout_price }}</p>
            @endif
            <p class="card-text"><strong>Seller:</strong> {{ $lot->seller()->name }}</p>
            <p class="card-text"><strong>End date:</strong> {{ $lot->end_time }}</p>
            <div class="col-5 p-0">
                <lots-timer-for-admin-component :lot="{{$lot}}"></lots-timer-for-admin-component>
            </div>
            <div class="btn-group">
                <a class="btn btn-success" href="{{ route('admin.lot.update', $lot) }}">Update</a>
                <a class="btn btn-danger" href="{{ route('admin.lot.delete', $lot) }}">Delete</a>
            </div>
        </div>

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
