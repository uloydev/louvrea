@extends('layouts.custom')

@section('content')
    <div class="container mt-4">
        <h2 class="best-seller-title">Wishlist</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h4>Total: {{ 'Rp ' . number_format($grandTotal, 0, ',', '.') }}</h4>
            <a href="payment.html" class="btn btn-buy-now">Checkout</a>
        </div>
    </div>
@endsection
