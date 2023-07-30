@extends('layouts.custom')

@section('content')
    <h2 class="text-center mt-5">{{ $cat != null ? $cat->name : 'All' }} Product Louvrea</h2>

    <section id="product-gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                @if ($search)
                                    Search Result : {{ $search }}
                                @else
                                    Filter Product
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <form action="{{ route('product-list') }}" id="filterForm" method="GET">
                                    <label for="category">Kategori:</label>
                                    <select id="category" class="form-control" name="cat">
                                        <option value="all">Semua</option>
                                        @foreach (App\Models\ProductCategory::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="text-end mb-3">
                        <button class="btn btn-primary bg-warning" type="submit" form="filterForm">Terapkan</button>
                    </div>
                    <div class="product-gallery">
                        @foreach ($products as $prod)
                            <div class="product-card">
                                <a href="{{route('product.detail', $prod->id)}}">
                                    <img src="{{ asset('storage/'.$prod->image) }}" alt="{{ $prod->name }}"></a>
                                <h4>{{ $prod->name }}</h4>
                                <p class="product-description text-center">{{ $prod->size }}</p>
                                <p class="price">{{ 'Rp ' . number_format($prod->price, 0, ',', '.') }}</p>
                                @if ($prod->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$prod->id}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class ="btn-buy-now">Add to Cart</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary" disabled>Stok Habis</button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
