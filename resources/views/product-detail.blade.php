@extends('layouts.custom')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-lg-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Harga: {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                <p>Deskripsi Produk:</p>
                <p>{{ $product->description }}</p>
                <p>Size:</p>
                <p>{{ $product->size }}</p>
                @if ($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-buy-now">Add to Cart</button>
                    </form>
                @else
                    <button class="btn btn-secondary" disabled>Stok Habis</button>
                @endif
            </div>
        </div>
    </div>
@endsection
