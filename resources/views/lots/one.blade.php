@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-light" href="{{back()->getTargetUrl()}}">Back</a>
        <h5 class="card-title"><strong>Цена:</strong> {{ $lot->price }}</h5>
        <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
        <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->parentProduct()->name }}</p>
    </div>
@endsection
