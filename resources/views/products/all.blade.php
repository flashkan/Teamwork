@extends('layouts.app')

@section('content')
    <product-all-component></product-all-component>  {{--компонент Vue--}}
    <div class="container-lg">
        <div class="row">
            @foreach ($products as $product)
                <div class="card col-3 p-1" style="width: 18rem;">
                    <img src="http://placehold.it/150x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Название:</strong> {{ $product->name }}</h5>
                        <p class="card-text"><strong>Описание:</strong> {{ $product->description }}</p>
                        <p class="card-text"><strong>Владелец:</strong> {{ $product->owner()->name }}</p>
                    </div>
                    <a class="btn btn-primary" href="{{route('product.one', $product)}}">More</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
