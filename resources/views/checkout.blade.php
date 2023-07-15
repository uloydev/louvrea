@extends('layouts.custom')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Checkout</h2>
                <hr>
                <h4>Informasi Produk</h4>
                @foreach ($items as $item)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset($item->product->image) }}" class="card-img"
                                    alt="{{ $item->product->name }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                    <p class="card-text">{{ $item->product->short_description }}</p>
                                    <p class="card-text">Harga:
                                        {{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}</p>
                                    <p class="card-text">Jumlah: {{ $item->quantity }}</p>
                                    <p class="card-text">SubTotal Produk:
                                        {{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <form action="{{ route('order.create') }}" method="post" id="submitOrder">
                    @csrf

                    {{-- <h4>Redeem Voucher</h4>
                    <div class="input-group mb-3">
                        <label for="voucherCode" class="input-group-text">Kode Voucher:</label>
                        <input type="text" class="form-control" id="voucherCode" name="voucherCode"
                            placeholder="Masukkan kode voucher">
                    </div> --}}



                    <!-- Tambahkan tombol untuk memicu modal -->
                    <h4>Alamat Pengiriman</h4>
                    <p>Masukkan alamat pengiriman</p>
                    <div class="form-group">
                        <label for="fullName">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="fullName" name="fullName"
                            placeholder="Masukkan nama lengkap" required>
                        @foreach ($errors->get('fullName') as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">Nomor Telepon:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                            placeholder="Masukkan nomor telepon" required>
                        @foreach ($errors->get('phoneNumber') as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="fullAddress">Alamat Lengkap:</label>
                        <input type="text" class="form-control" id="fullAddress" name="fullAddress"
                            placeholder="Masukkan alamat lengkap" required>
                        @foreach ($errors->get('fullAddress') as $item)
                            <p>{{ $item }}</p>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="addressDetail">Detail Lainnya:</label>
                        <textarea class="form-control" id="addressDetail" name="addressDetail" placeholder="Masukkan detail lainnya"></textarea>
                    </div>

                    <h4>Layanan Pengiriman</h4>
                    <div class="form-group">
                        <label for="shippingMethod">Pilih layanan pengiriman:</label>
                        <select class="form-control" id="shippingMethod" name="shippingMethod">
                            @foreach ($shipping_methods as $method)
                                <option value="{{ $method }}" selected>{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>


                <h4>Rincian Harga</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Total</td>
                            <td>{{ 'Rp ' . number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-link mb-3" type="button" data-toggle="collapse" data-target="#subtotalCollapse"
                    aria-expanded="false" aria-controls="subtotalCollapse">
                    Detail Harga
                </button>
                <div class="collapse" id="subtotalCollapse">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{ 'Rp ' . number_format($subTotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim</td>
                                <td>{{ 'Rp ' . number_format($shipping, 0, ',', '.') }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Diskon Voucher</td>
                                <td>$XX.XX</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>


                <div class="text-left">
                    <button type="submit" class="btn btn-buy-now" form="submitOrder">Complete Order</button>
                </div>
            </div>
        </div>
    </div>
@endsection
