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
                        <td>{{ $item->product->name }}</td>
                        <td>{{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.modify', $item->id) }}" method="POST" id="formIncrement">
                                @csrf
                                @method('POST')
                                <input type="number" name="value" hidden value="1">
                            </form>
                            <form action="{{ route('cart.modify', $item->id) }}" method="POST" id="formDecrement">
                                @csrf
                                @method('POST')
                                <input type="number" name="value" hidden value="-1">
                            </form>
                            <button class="btn btn-sm btn-primary bg-dark" type="submit" form="formIncrement">+</button>
                            <span class="mx-2">
                                {{ $item->quantity }}
                            </span>
                            <button class="btn btn-sm btn-primary bg-dark" type="submit" form="formDecrement">-</button>
                        </td>
                        <td>{{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h4>Total: {{ 'Rp ' . number_format($grandTotal, 0, ',', '.') }}</h4>
            <a href="{{ route('cart.checkout-summary') }}" class="btn btn-buy-now">Checkout</a>
        </div>
    </div>
@endsection
