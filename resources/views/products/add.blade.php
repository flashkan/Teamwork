@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="product_name">Name:</label>
                <input name="name" type="text" class="form-control" id="product_name" placeholder="Name product"
                       value="{{ old('name') ?: $product->name }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_description">Description:</label>
                <textarea name="description" type="textarea" class="form-control" id="product_description"
                          placeholder="Description product">{{ old('description') ?: $product->description }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
