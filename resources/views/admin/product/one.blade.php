@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <h5 class="card-title"><strong>Название:</strong> {{ $product->name }}</h5>
        <p class="card-text"><strong>Описание:</strong> {{ $product->description }}</p>
        <p class="card-text"><strong>Владелец:</strong> {{ $product->owner()->name }}</p>
        <a class="btn btn-success" href="{{ route('admin.product.update', $product) }}">Update</a>
        <a class="btn btn-danger" href="{{ route('admin.product.delete', $product) }}">Delete</a>
    </div>
@endsection
