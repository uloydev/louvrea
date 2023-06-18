@extends('layouts.custom')

@section('content')
    <h2 class="text-center mt-5">All Product Louvrea</h2>

    <section id="product-gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Filter Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="category">Kategori:</label>
                                <select id="category" class="form-control">
                                    <option value="all">Semua</option>
                                    <option value="skincare">Skincare</option>
                                    <option value="makeup">Makeup</option>
                                    <option value="perfume">Parfum</option>
                                    <option value="men">Louvrea For Men</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="text-end mb-3">
                        <button class="btn btn-primary bg-warning">Terapkan</button>
                    </div>



                    <div class="product-gallery">
                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 1"></a>
                            <h4>Product 1</h4>
                            <p class="product-description text-center">10ml</p>
                            <p class="price">$19.99</p>
                            <a href="#" class="btn-buy-now">Add to Cart</a>
                        </div>


                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 2"class="img-fluid"></a>
                            <h4>Product 2</h4>
                            <p class="product-description text-center">10ml</p>
                            <p class="price">$29.99</p>
                            <a href="#" class="btn-buy-now">Add to Cart</a>
                        </div>


                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 1"></a>
                            <h4>Product 1</h4>
                            <p class="product-description text-center">20ml</p>
                            <p class="price">$19.99</p>
                            <a href="#" class="btn-buy-now">Add to Cart</a>
                        </div>

                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 2"></a>
                            <h4>Product 2</h4>
                            <p class="product-description text-center">20ml</p>
                            <p class="price">$29.99</p>
                            <a href="#" class="btn-buy-now">Add to Cart</a>
                        </div>

                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 2"></a>
                            <h4>Product 2</h4>
                            <p class="product-description text-center">20ml</p>
                            <p class="price">$29.99</p>
                            <button class="btn-buy-now">Add to Cart</button>
                        </div>

                        <div class="product-card">
                            <a href="produk.html">
                                <img src="img/bbb.jpg" alt="Product 2"></a>
                            <h4>Product 2</h4>
                            <p class="product-description text-center">20ml</p>
                            <p class="price">$29.99</p>
                            <button class="btn-buy-now">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
