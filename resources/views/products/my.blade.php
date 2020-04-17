@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1>Your products</h1>
        <div class="row">
            @forelse ($products as $product)
                    <div class="card col-3 p-1" style="width: 18rem;">
                        <div class="card-body">
                            <p>Name: {{ $product->name }}</p>
                            <p>Description: {{ $product->description }}</p>
                        </div>
                        <a class="btn btn-primary" href="{{route('product.one', $product)}}">More</a>
                    </div>
            @empty
                <h2 class="text-center col-12">You don't have products in your account</h2>
            @endforelse
        </div>
    </div>
@endsection
