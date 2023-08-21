@extends('layouts.custom')

@section('content')
    <div id="snap-container" class="container"></div>
    <div class="container my-4">
        <h3>My Order</h3>
        <ul class="list-group">
            @foreach ($orders as $order)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8">
                            Order #{{ $order->id }}
                            <p>Status: {{ $order->status }}</p>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-block btn-warning" data-toggle="modal"
                                data-target="#detailModal{{ $order->id }}">Detail</button>
                            @if ($order->status == 'FINISHED' and count($order->orderItems) > count($order->ratings))
                                <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-target="#ratingModal{{ $order->id }}">Buat Review</button>
                            @endif
                        </div>
                    </div>
                </li>

                <!-- Modal -->
                <div class="modal fade" id="ratingModal{{ $order->id }}" tabindex="-1" role="dialog"aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Order Rating & Review</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($order->ratings as $rat)
                                    <div class="p-2 border border-warning border-lg mx-2 my-4">
                                        <h5>{{ $rat->product->name }}</h5>
                                        <p class="text-warning"><i class="icofont-star pr-2"></i>{{ $rat->rating }}</p>
                                        @if ($rat->review)
                                            <blockquote>
                                                {{ $rat->review }}
                                            </blockquote>
                                        @endif
                                    </div>
                                @endforeach

                                @foreach ($order->orderItems->whereNotIn('product_id', $order->ratings->pluck('product_id')) as $item)
                                    <form class="p-2 border border-warning mx-2 my-4" id="ratingForm{{ $order->id }}" action="{{route('order.my-order.rating', $item->id)}}" method="POST">
                                        @csrf
                                        <h5>{{ $item->product->name }}</h5>
                                        <p>Rating</p>
                                        <div class="rating">
                                            <input type="radio" name="rating" id="star1-{{$item->id}}" value="1" required>
                                            <label for="star1-{{$item->id}}"><i class="icofont-star"></i></label>
                                            <input type="radio" name="rating" id="star2-{{$item->id}}" value="2" required>
                                            <label for="star2-{{$item->id}}"><i class="icofont-star"></i></label>
                                            <input type="radio" name="rating" id="star3-{{$item->id}}" value="3" required>
                                            <label for="star3-{{$item->id}}"><i class="icofont-star"></i></label>
                                            <input type="radio" name="rating" id="star4-{{$item->id}}" value="4" required>
                                            <label for="star4-{{$item->id}}"><i class="icofont-star"></i></label>
                                            <input type="radio" name="rating" id="star5-{{$item->id}}" value="5" required>
                                            <label for="star5-{{$item->id}}"><i class="icofont-star"></i></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review</label>
                                            <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-block">Submit Rating</button>
                                    </form>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        @if ($order->awb_number)
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
                                                            <td>{{ $item->product->name }}</td>
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
                                        <div class="my-4">
                                            <h4>
                                                Payment Status :
                                                @if ($order->payment_status == '1')
                                                    Belum Bayar
                                                @elseif($order->payment_status == '2')
                                                    Pembayaran Sukses
                                                @elseif($order->payment_status == '3')
                                                    Pembayaran Kadaluarsa
                                                @elseif($order->payment_status == '4')
                                                    Pembayaran Gagal
                                                @endif
                                            </h4>
                                        </div>
                                        <!-- Move rating and comments section here -->
                                    </div>
                                </div>
                                @if ($order->status == 'PENDING' and $order->payment_status != '2')
                                    <button class="btn btn-warning btn-block"
                                        onclick="pay('{{ $order->payment_url }}')">Bayar
                                        Sekarang</button>
                                @endif
                                @if ($order->status == 'PENDING')
                                    <form action="{{ route('order.my-order.delete', $order->id) }}" method="post"
                                        id="deleteForm{{ $order->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn btn-danger btn-block mt-2" type="submit"
                                        form="deleteForm{{ $order->id }}">Hapus Order</button>
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

@push('script')
    <script>
        const pay = (payUrl) => {
            window.open(payUrl, '_blank');
        };

        $(document).ready(function () {
            $('input[name="rating"]').on('click', function () {
                const labels =  $(this).siblings('label');
                labels.css('color','darkgray');
                labels.slice(0,$(this).val()).css('color','#ffc107');
            });
            console.log($('input[name="rating"]'));
        });
    </script>
@endpush

@push('css')
    <style>
        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 20px;
            height: 20px;
            margin: 0;
            padding: 0;
            color: darkgray;
        }
    </style>
@endpush
