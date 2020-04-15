@extends('admin.index')

@section('admin.content')
    <div class="container-lg">
        <div class="row">
            @foreach ($lots as $lot)
                <div class="card col-4 p-1" style="width: 18rem;">
                    <img src="http://placehold.it/150x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Стартовая цена:</strong> {{ $lot->start_price }}</h5>
                        @if(isset($lot->buyback_price))
                            <h5 class="card-title"><strong>Цена выкупа:</strong> {{ $lot->buyback_price }}</h5>
                        @endif
                        <p class="card-text"><strong>Дата окончание:</strong> {{ $lot->end_time }}</p>
                        <p class="card-text"><strong>Принадлежит продукту:</strong> {{ $lot->product()->name }}</p>
                    </div>
                    <lots-timer-component :lot="{{$lot}}" :url="'{{ route('lot.one', $lot) }}'"></lots-timer-component>
                </div>
            @endforeach
        </div>
        {{ $lots->links() }}
    </div>
@endsection
