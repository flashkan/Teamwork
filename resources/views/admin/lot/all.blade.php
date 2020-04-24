@extends('admin.index')

@section('admin.content')
    <div class="container-lg">
        <a class="btn btn-success" href="{{ route('admin.lot.add') }}">Create new</a>
        <div class="row m-1">
            @foreach ($lots as $lot)
                <div class="card col-4 p-1" style="width: 18rem;">
                    <div class="card-body">
                        <img class="card-img p-0 my-2" src="{{ $lot->product()->img_url
? Storage::url($lot->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                        <h4 class="card-text"><strong>Product:</strong> {{ $lot->product()->name }}</h4>
                        <h5 class="card-title"><strong>Start price:</strong> {{ $lot->start_price }}</h5>
                        @if(isset($lot->buyback_price))
                            <p class="card-title"><strong>Buyback price:</strong> {{ $lot->buyback_price }}</p>
                        @endif
                    </div>
                    <lots-timer-for-admin-component :lot="{{$lot}}"></lots-timer-for-admin-component>
                    <a class="btn btn-primary" href="{{route('admin.lot.one', $lot)}}">More</a>
                </div>
            @endforeach
        </div>
        {{ $lots->links() }}
    </div>
@endsection
