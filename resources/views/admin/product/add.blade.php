@extends('admin.index')

@section('admin.content')
    <div class="container">
        <a class="btn btn-outline-primary" href="{{back()->getTargetUrl()}}">&#9668 Back</a>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_owner_id">User:</label>
                <select name="owner_id" class="form-control" id="user_owner_id" required>
                    <option disabled>Select user</option>
                    @foreach($users as $user)
                        <option
                            @if(((int) old('owner_id') ?: (int) $product->owner_id) === (int) $user->id) selected @endif
                        value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </select>
                @error('owner_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @isset($product->img_url)
                <img class="card-img col-4 p-0 my-2" src="{{ Storage::url($product->img_url)}}" alt="img_product">
                <div class="form-group form-check">
                    <input name="img_del" type="checkbox" class="form-check-input" id="exampleCheck1" value="1">
                    <label class="form-check-label" for="exampleCheck1">Delete current image? New image will not be
                        uploaded.</label>
                </div>
            @endisset
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload image:</label>
                <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
                @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
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
