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
            </div>
            <div class="form-group">
                <label for="lot_price">Price:</label>
                <input name="price" type="number" step="0.01" class="form-control" id="lot_price" placeholder="price"
                       value="{{ old('price') ?: $lot->price }}">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_end_time">End time:</label>
                <input name="end_time" type="datetime-local" class="form-control" id="lot_end_time"
                       placeholder="end_time"
                       value="{{ old('end_time') ?: $lot->end_time }}">
                @error('end_time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
