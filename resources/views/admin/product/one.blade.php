@extends('admin.index')

@section('admin.content')
    <div class="container d-flex justify-content-center align-items-start flex-column">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <img class="card-img col-4 p-0 my-2" src="{{ $product->img_url ? Storage::url($product->img_url)
            : Storage::url('placeholder.jpg') }}" alt="img_product">
        <h5 class="card-title"><strong>Name product:</strong> {{ $product->name }}</h5>
        <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
        <p class="card-text"><strong>Owner:</strong> {{ $product->owner()->name }}</p>
        <div class="btn-group">
            <a class="btn btn-success" href="{{ route('admin.product.update', $product) }}">Update</a>
            <a class="btn btn-danger" href="{{ route('admin.product.delete', $product) }}">Delete</a>
        </div>
    </div>
@endsection
