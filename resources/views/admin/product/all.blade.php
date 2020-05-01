@extends('admin.index')

@section('admin.content')
    <div class="container-lg">
        <a class="btn btn-success" href="{{ route('admin.product.add') }}">Create new</a>
        <div class="row m-1">
            @foreach ($products as $product)
                <div class="card col-3 p-1" style="width: 18rem;">
                    <img class="card-img p-0 my-2 products-in-admin" src="{{ $product->img_url ? Storage::url($product->img_url)
                        : Storage::url('placeholder.jpg') }}" alt="img_product">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Name product:</strong> {{ $product->name }}</h5>
                        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                        <p class="card-text"><strong>Owner:</strong> {{ $product->owner()->name }}</p>
                    </div>
                    <a class="btn btn-primary" href="{{route('admin.product.one', $product)}}">More</a>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
