@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="user_seller_id">User:</label>
                <select name="seller_id" class="form-control" id="user_seller_id" required>
                    <option disabled>Select user</option>
                    @foreach($users as $user)
                        <option
                            @if(((int) old('seller_id') ?: (int) $lot->seller_id) === (int) $user->id) selected @endif
                        value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
                @error('owner_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_product_id">Product:</label>
                <select name="product_id" class="form-control" id="lot_product_id" required>
                    <option disabled>Выберете продукт</option>
                    @foreach($products as $product)
                        <option
                            @if(((int) old('product_id') ?: (int) $lot->product_id) === (int) $product->id) selected @endif
                        value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
                @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_start_price">Start price:</label>
                <input name="start_price" type="number" min="0.01" step="0.01" class="form-control" id="lot_start_price"
                       placeholder="Start price" value="{{ old('start_price') ?: $lot->start_price }}" required>
                @error('start_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_buyout_price">Buyout price:</label>
                <input name="buyout_price" type="number" step="0.01" class="form-control" id="lot_buyout_price"
                       placeholder="Buyout price" value="{{ old('buyout_price') ?: $lot->buyout_price }}">
                @error('buyout_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lot_end_time">End time:</label>
                <datetime name="end_time" type="datetime" input-class="form-control" format="d.MM.y HH:mm"
                          placeholder="End time" title="Enter end date and time"
                          value="{{ old('end_time') ?: $lot->end_time }}" required></datetime>
                @error('end_time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
