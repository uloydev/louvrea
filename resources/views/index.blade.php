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
            @foreach($products as $prod)
                <div class="col-md-4">
                    <div class="best-seller-card text-center">
                        <a href="{{route('product.detail', $prod->id)}}">
                            <img src="{{asset($prod->image)}}" alt="{{ $prod->name }}" class="img-fluid">
                        </a>
                        <div class="product-details">
                            <h4 class="product-title text-center">{{ $prod->name }}</h4>
                            <p class="product-description text-center">{{ $prod->short_description }}
                            </p>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$prod->id}}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class ="btn-buy-now">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
