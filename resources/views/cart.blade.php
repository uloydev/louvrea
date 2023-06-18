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
                @for ($i = 0; $i < 6; $i++)
                    <tr>
                        <td>Produk 1</td>
                        <td>$10</td>
                        <td>2</td>
                        <td>$20</td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="text-right">
            <h4>Total: $50</h4>
            <a href="payment.html" class="btn btn-buy-now">Checkout</a>
        </div>
    </div>
@endsection
