@extends('layouts.custom')

@section('content')
    <div class="container my-4">
        <h3>My Order</h3>
        <ul class="list-group">
            @foreach ($orders as $order)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8">Order #{{ $order->id }}</div>
                        <div class="col-md-4"><button class="btn btn-block btn-warning" data-toggle="modal"
                                data-target="#detailModal{{ $order->id }}">Detail</button></div>
                    </div>
                    <p>Status: {{ $order->status }}</p>
                </li>
                <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">My Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Isi dengan informasi detail order -->
                                <div class="container">
                                    <div class="my-4">
                                        <h4>Order ID: {{ $order->id }}</h4>
                                        @if($order->awb_number)
                                            <h4>Nomor Resi: {{ $order->awb_number }}</h4>
                                        @endif
                                        <p>Order Date: {{ $order->created_at->format('d F Y H:i:s') }}</p>
                                        <p>Shipping Method: {{ $order->shipping_method }}</p>
                                    </div>

                                    <div class="my-4">
                                        <h4>Alamat Pengiriman</h4>
                                        <p class="card-text">Shipping Address:<br> {{ $order->address }}</p>
                                        <div class="my-4">
                                            <h4>Order detail</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Harga</th>
                                                        <th>Quantity</th>
                                                        <th>SubTotal Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderItems as $item)
                                                        <tr>
                                                            <td>T-Shirt</td>
                                                            <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ 'Rp ' . number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <h4>Rincian Harga</h4>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>{{ 'Rp ' . number_format($order->order_price, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ongkos Kirim</td>
                                                    <td>{{ 'Rp ' . number_format($order->shipping_price, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Diskon Voucher</td>
                                                    <td>$XX.XX</td>
                                                </tr> --}}
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="my-4">
                                            <h4>Status : {{ $order->status }}</h4>
                                        </div>
                                    </div>
                                </div>
                                @if ($order->status == 'PENDING')
                                    <button class="btn btn-warning btn-block">Bayar Sekarang</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Tambahkan order lainnya sesuai kebutuhan -->
        </ul>
    </div>

    <!-- Modal Pop-up -->
@endsection
