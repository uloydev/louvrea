@extends('layouts.custom')


@section('content')

<div class="container">
    <h2 class="text-center my-4">About Us</h2>
    <p class="text-center my-4">Louvrea adalah brand lokal yang memproduksi skincare, 
      makeup hingga Perfume dengan menggunakan bahan-bahan berkualitas tinggi dan memiliki sertifikat halal. 
      Louvrea menyediakan berbagai macam produk perawatan wajah seperti Serum, Body Care Louvrea, Facial Wash Louvrea, 
      Lip Serum Louvrea, Eye Cream Louvrea hingga produk makeup seperti Makeup Louvrea,  Lip Cream Louvrea. 
      Louvrea juga menyediakan berbagai macam produk untuk pria seperti, 
      Cream Wajah Louvrea, Facial Wash, hingga Toner. Harga yang ditawarkan juga relatif terjangkau.</p>
      
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <img src="{{ asset('img/dailyglow.jpg') }}" alt="Gambar 1" class="img-fluid">
        </div>
        <div class="col-sm-3">
            <img src="{{ asset('img/lipposerum.jpg') }}" alt="Gambar 2" class="img-fluid">
        </div>
        <div class="col-sm-3">
            <img src="{{ asset('img/toner.jpg') }}" alt="Gambar 3" class="img-fluid">
        </div>
        <div class="col-sm-3">
            <img src="{{ asset('img/facialwash.jpg') }}" alt="Gambar 4" class="img-fluid">
        </div>
    </div>
</div>
 
@endsection
