<head>
   <link rel="stylesheet" type="text/css" href={{ URL::asset('assets/products.css') }}>
</head>

<h1>Your products</h1>
<div class="productWrapper">
    @forelse ($products as $product)
        <div class="product">
            <p>Name: {{ $product->name }}</p>
            <p>Description: {{ $product->description }}</p>
        </div>
    @empty
        <h2>You don't have products in your account</h2>
    @endforelse
</div>
