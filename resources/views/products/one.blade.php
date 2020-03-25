@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-light" href="{{back()->getTargetUrl()}}">Back</a>
        <h5 class="card-title"><strong>Название:</strong> {{ $product->name }}</h5>
        <p class="card-text"><strong>Описание:</strong> {{ $product->description }}</p>
        <p class="card-text"><strong>Владелец:</strong> {{ $product->owner()->name }}</p>
        <a class="btn btn-success" href="{{ route('product.update', $product) }}">Update</a>
        <a class="btn btn-danger" href="{{ route('product.delete', $product) }}">Delete</a>
    </div>
@endsection
