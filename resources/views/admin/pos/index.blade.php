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
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Product</h3>
                            <a class="btn btn-sm btn-primary" href="{{ route('product.create') }}"
                                style="float: right;">Create</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Id</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Root</th>
                                        <th>buying_price</th>
                                        <th>selling_price</th>
                                        <th>buying_date</th>
                                        <th>image</th>
                                        <th>product_quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="row mb-3">
                        <!-- Area Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">
                                        expense_insert
                                    </h5>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 12px">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>name</th>
                                                    <th style="text-align: center">
                                                        qty
                                                    </th>
                                                    <th>unit</th>
                                                    <th>total</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>.product_name</td>
                                                    <td>
                                                        <div
                                                            class="d-flex justify-content-center bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">

                                                            </span>
                                                            <span class="d-flex justify-content-center" style="width: 30px">
                                                                <div>product_quantity</div>
                                                            </span>

                                                        </div>
                                                    </td>
                                                    <td>product_price</td>
                                                    <td>sub_total</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-danger action" style="color: white">X</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="px-4">

                                </div>
                                <div class="card-footer">
                                    <div class="order-md-2 mb-4">
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div>
                                                    <h6 class="my-0">
                                                        total_quantity
                                                    </h6>
                                                </div>
                                                <span class="text-muted"> qty </span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div>
                                                    <h6 class="my-0">
                                                        sub_total
                                                    </h6>
                                                </div>
                                                <span class="text-muted">sub_total</span>
                                            </li>

                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div>
                                                    <h6 class="my-0">
                                                        vat
                                                    </h6>
                                                </div>
                                                <span class="text-muted">vat %</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between bg-light">
                                                <div class="text-success">
                                                    <h6 class="my-0">
                                                        total
                                                    </h6>
                                                </div>
                                                <span class="text-success">total</span>
                                            </li>
                                            <li v-if="giftCardId"
                                                class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div>
                                                    <h6 class="my-0">Gift Card</h6>
                                                </div>
                                                <span class="text-muted"> - total</span>
                                            </li>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">
                                        products
                                    </h5>

                                    <input type="text" class="form-control" style="width: 300px" />
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">home</a>
                                    </li>

                                    <li class="nav-item" role="presentation" v-for="category in categories"
                                        :key="category.id">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">category_name </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="item in filtersearch"
                                                    :key="item.id">
                                                    <div class="card" style="align-items: center; margin-bottom: 10px">
                                                        <button class="btn btn-sm"
                                                            :class="disableButton ? 'pointer-events-none' : ''" >
                                                                <div class="img-container">
                                                                    <img :src="item.image ?
                                                                        item.image :
                                                                        '/backend/img/none-img.jpg'"
                                                                        class="card-img-top" id="image_size" alt="..." />
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center">
                                                                        product_name -
                                                                        selling_price
                                                                    </h5>
                                                                    <td>
                                                                        <span class="badge badge-success">available
                                                                            <span class="badge badge-light">
                                                                                product_quantity
                                                                            </span></span>
                                                                    </td>

                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
@endsection
