@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1>Your lots</h1>
        <div class="row">
            @forelse ($lots as $lot)
                    <div class="card col-4 p-1" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Стартовая цена:</strong> {{ $lot->start_price }}</h5>
                            @if(($lot->buyback_price))
                                <h5 class="card-title"><strong>Цена выкупа:</strong> {{ $lot->buyback_price }}</h5>
                            @endif
                            <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
                            <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->product()->name }}</p>
                        </div>
                        <lots-timer-component :lot="{{$lot}}" :url="'{{ route('lot.one', $lot) }}'"></lots-timer-component>
                    </div>
            @empty
                <h2 class="text-center col-12">You don't have lot for your products</h2>
            @endforelse
        </div>
    </div>
@endsection
