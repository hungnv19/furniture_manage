@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pos List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Pos</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        @if ($products->count() > 0)
            <section class="section-products">
                <div class="container">
                    <div class="row">
                        <!-- Single Product -->
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div id="product-1" class="single-product">
                                    <div class="part-1">
                                        <img src=" {{ Storage::url($product->image) }}"
                                            style="width: 300px; height: 300px; object-fit: cover" />
                                        <ul>
                                            <li><a href="{{ route('cart.addToCart', $product->id) }}"><i
                                                        class="fas fa-shopping-cart"></i></a></li>
                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>

                                        </ul>
                                    </div>
                                    <div class="part-2">
                                        <h3 class="product-title">{{ $product->product_name }}</h3>
                                        <h4 class="product-price">{{ $product->selling_price }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @else
            <section class="section-products">
                <div class="container">
                    <div class="row">
                        <!-- Single Product -->
                        <data-empty></data-empty>

                    </div>
                </div>
            </section>
        @endif

    </section>
@endsection
