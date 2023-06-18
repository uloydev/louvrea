@extends('layouts.custom')

@section('content')
    <section id="home">
        <!-- Home section content -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active gelap">
                    <img src="{{ asset('img/image1.jpg') }}" alt="Banner 1">
                    <div class="carousel-caption">
                        <h3 class="carousel-caption">Loving Your Skin in Reality</h3>
                        <p>LOUVREA</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/image1.jpg') }}" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/image1.jpg') }}" alt="Banner 3">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </section>

    <div class="container" style="margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="best-seller-title text-center">Our Best Selling Products</h2>
                <hr class="divider">
            </div>
        </div>
        <div class="row">
            @for ($i = 0; $i < 6; $i++)
                <div class="col-md-4">
                    <div class="best-seller-card text-center">
                        <a href="#">
                            <img src="{{asset("img/bbb.jpg")}}" alt="Product Image" class="img-fluid">
                        </a>
                        <div class="product-details">
                            <h4 class="product-title text-center">Product 1</h4>
                            <p class="product-description text-center">Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.
                            </p>
                        </div>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary btn-buy-now text-dark">Add to cart</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
