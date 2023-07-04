@extends('layouts.custom')

@section('content')
    <div class="container">
        <h2 class="text-center my-4">Cara Pemesanan</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-shopping-cart fa-3x"></i></h3>
                    <h5 class="text-center">1. Pilih Item dan Tambahkan ke Keranjang</h5>
                    <p>Pilih item yang diinginkan dan klik tombol "Add to Cart" untuk menambahkannya ke keranjang belanja
                        Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-user fa-3x"></i></h3>
                    <h5 class="text-center">2. Login atau Register</h5>
                    <p>Login terlebih dahulu jika Anda sudah memiliki akun atau lakukan registrasi jika belum memiliki akun.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-credit-card fa-3x"></i></h3>
                    <h5 class="text-center">3. Checkout</h5>
                    <p>Setelah selesai memilih item, klik tombol "Checkout" untuk melanjutkan ke proses pembayaran.</p>
                </div>
            </div>


            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-edit fa-3x"></i></h3>
                    <h5 class="text-center">5. Isi Data dan Langkah Selanjutnya</h5>
                    <p>Isi data yang diperlukan di dalam kolom dan klik tombol "Checkout" untuk melanjutkan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-ticket-alt fa-3x"></i></h3>
                    <h5 class="text-center">6. Voucher Code/Referral</h5>
                    <p>Jika Anda memiliki kode voucher atau referral, masukkan kode tersebut ke dalam kotak yang disediakan.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-check fa-3x"></i></h3>
                    <h5 class="text-center">7. Selesaikan Pemesanan</h5>
                    <p>Klik tombol "Complete Order" untuk menyelesaikan pemesanan Anda. Anda akan mendapatkan Order ID,
                        total pesanan, dan nomor rekening untuk melakukan pembayaran.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <h3 class="text-center"><i class="fas fa-clipboard-check fa-3x"></i></h3>
                    <h5 class="text-center">8. Konfirmasi Pembayaran</h5>
                    <p>Setelah melakukan pembayaran, silakan konfirmasi melalui link "Confirm Payment" yang tersedia di
                        invoice yang akan dikirim melalui email atau melalui website kami.</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="step-card">
                <h2 class="text-center my-4">Cara pengembalian/Return</h2>
                <p>Jika produk yang dikirimkan oleh tim kami terdapat kesalahan, maka kami akan mengirimkan produk yang
                    dipesan & mengembalikan Shipping Fee terhadap produk yang dikembalikan ke kami seluruhnya.
                    Produk yang dikembalikan harus dalam kondisi tersegel & belum dicoba/dipakai sama sekali. Proses Retur
                    biasanya memakan waktu 3hari kerja.
                    Claim maksimal diajukan H+1 minggu dari tanggal pengiriman dilakukan</p>
            </div>
        </div>
    </div>
@endsection
