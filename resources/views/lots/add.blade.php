@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="lot_product_id">Product:</label>
                <select name="product_id" class="form-control" id="lot_product_id">
                    <option disabled>Выберете продукт</option>
                    @forelse($products as $product)

                        <option
                            @if((int) old('product_id') === (int) $product->id) selected @endif
                        value="{{$product->id}}">{{$product->name}}</option>
                    @empty

                    @endforelse
                </select>
                @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_start_price">Start price:</label>
                <input name="start_price" type="number" step="0.01" class="form-control" id="lot_start_price"
                       placeholder="Start price" value="{{ old('start_price') ?: $lot->buyback_price }}">
                @error('start_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_buyback_price">Buyback price:</label>
                <input name="buyback_price" type="number" step="0.01" class="form-control" id="lot_buyback_price"
                       placeholder="Buyback price" value="{{ old('buyback_price') ?: $lot->buyback_price }}">
                @error('buyback_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_end_time">End time:</label>
                <input name="end_time" type="datetime-local" class="form-control" id="lot_end_time"
                       placeholder="end_time" value="{{ old('end_time') ?: $lot->end_time }}">
                @error('end_time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
