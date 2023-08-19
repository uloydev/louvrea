@extends('layouts.custom')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-5">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-lg-6 mb-5">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Harga: {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                <p>Deskripsi Produk:</p>
                <p>{{ $product->description }}</p>
                <p>Size:</p>
                <p>{{ $product->size }}</p>
                <p class="text-warning">
                    @if (count($product->ratings))
                        <i class="icofont-star"></i>
                        {{ $product->ratings->avg('rating') }}
                    @else
                        Belum Ada Rating
                    @endif
                </p>
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
            <div class="col-lg-8 mx-2 my-4 p-4 rounded">
                <h3>Reviews</h3>
                <hr>
                @forelse ($product->ratings as $rat)
                    <div class="border border-warning px-4 py-2 mx-2 my-3 rounded">
                        <i><b>{{ $rat->user->name }}</b></i>
                        <blockquote class="pl-4 mb-0">" {{ $rat->review }} "</blockquote>
                    </div>
                @empty
                    <p class="text-center p-2">Belum Ada Review</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
