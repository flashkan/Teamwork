@extends('admin.index')

@section('admin.content')
    <div class="container d-flex justify-content-center align-items-start flex-column">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <img class="card-img col-4 p-0 my-2" src="{{ $product->img_url ? Storage::url($product->img_url)
            : Storage::url('placeholder.jpg') }}" alt="img_product">
        <h5 class="card-title"><strong>Name product:</strong> {{ $product->name }}</h5>
        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
        <p class="card-text"><strong>Owner:</strong> {{ $product->owner()->name }}</p>
        <div class="btn-group mb-4">
            <a class="btn btn-success" href="{{ route('admin.product.update', $product) }}">Update</a>
            @if($product->is_delete)
                <a class="btn btn-danger" href="{{ route('admin.product.show', $product) }}">Show</a>
            @else
                <a class="btn btn-danger" href="{{ route('admin.product.hide', $product) }}">Hide</a>
            @endif
            <a class="btn btn-outline-danger" href="{{ route('admin.product.delete', $product) }}">Delete (Hard)</a>
        </div>
        <h4>Lots from the product</h4>
        @foreach ($product->ownerLots() as $lot)
            <div class="card col-4 p-1" style="width: 18rem;">
                <div class="card-body">
                    <img class="card-img p-0 my-2" src="{{ $lot->product()->img_url
? Storage::url($lot->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                    <h4 class="card-text"><strong>Product:</strong> {{ $lot->product()->name }}</h4>
                    <h5 class="card-title"><strong>Start price:</strong> {{ $lot->start_price }}</h5>
                    @if(isset($lot->buyout_price))
                        <p class="card-title"><strong>Buyout price:</strong> {{ $lot->buyout_price }}</p>
                    @endif
                </div>
                <lots-timer-for-admin-component :lot="{{$lot}}"></lots-timer-for-admin-component>
                <a class="btn btn-primary" href="{{route('admin.lot.one', $lot)}}">More</a>
            </div>
        @endforeach
    </div>
@endsection
