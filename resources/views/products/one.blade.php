@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-light" href="{{back()->getTargetUrl()}}">Back</a>
        <h5 class="card-title"><strong>Название:</strong> {{ $product->name }}</h5>
        <p class="card-text"><strong>Описание:</strong> {{ $product->description }}</p>
        <p class="card-text"><strong>Владелец:</strong> {{ $product->owner()->name }}</p>
    </div>
@endsection
