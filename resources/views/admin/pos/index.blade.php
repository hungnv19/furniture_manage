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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pos</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">

        {{-- <div>
            <div class="row mb-3">
                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 12px">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th style="text-align: center">Quantity</th>
                                            <th>Unit</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="order-md-2 mb-4">
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Total Quantity</h6>
                                        </div>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Sub Total</h6>
                                        </div>

                                    </li>

                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Vat</h6>
                                        </div>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <div class="text-success">
                                            <h6 class="my-0">Total</h6>
                                        </div>

                                    </li>
                                    <li v-if="giftCardId"
                                        class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Gift Card</h6>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="m-0 font-weight-bold text-primary">products</h5>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">home</a>
                            </li>


                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                                                <div class="card" style="align-items: center; margin-bottom: 10px">
                                                    <button class="btn btn-sm"
                                                        :class="disableButton ? 'pointer-events-none' : ''">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-center">
                                                                {{ $product->product_name }} -
                                                                {{ number_format($product->selling_price) }}
                                                            </h5>
                                                            @if ($product->product_quantity >= 1)
                                                                <td class="text-success">
                                                                    Available
                                                                </td>
                                                            @else
                                                                <td class="text-danger">
                                                                    Stock Out
                                                                </td>
                                                            @endif
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">

                                            <div class="card" style="align-items: center; margin-bottom: 10px">

                                                @foreach ($products as $product)
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">
                                                            {{ $product->product_name }} -
                                                            {{ number_format($product->selling_price) }}
                                                        </h5>
                                                        @if ($product->product_quantity >= 1)
                                                            <td class="text-success">
                                                                Available
                                                            </td>
                                                        @else
                                                            <td class="text-danger">
                                                                Stock Out
                                                            </td>
                                                        @endif

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <section class="section-products">
            <div class="container">
                <div class="row">
                    <!-- Single Product -->
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div id="product-1" class="single-product">

                                <div class="part-1">
                                    <img src=" {{ Storage::url($product->image) }}" style="width: 300px; height: 300px; object-fit: cover" />
                                    <ul>
                                        <li><a href="{{ route('cart.addToCart', $product->id) }}"><i class="fas fa-shopping-cart"></i></a></li>
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
    </section>
@endsection
