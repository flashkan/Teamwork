@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-light" href="{{back()->getTargetUrl()}}">Back</a>
        <h5 class="card-title"><strong>Стартовая цена:</strong> {{ $lot->start_price }}</h5>
        @if(isset($lot->buyback_price))
            <h5 class="card-title"><strong>Цена выкупа:</strong> {{ $lot->buyback_price }}</h5>
        @endif
        <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
        <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->product()->name }}</p>
        <div class="col-5 p-0">
            <lot-timer-component :lot="{{$lot}}"></lot-timer-component>
        </div>
        <a class="btn btn-success" href="{{ route('lot.update', $lot) }}">Update</a>
        <a class="btn btn-danger" href="{{ route('lot.delete', $lot) }}">Delete</a>
    </div>
@endsection
