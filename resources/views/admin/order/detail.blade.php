@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Booking</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid" id="container-wrapper">


            <div class="row mb-3">
                <!-- Table 1 -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                title
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b> name : </b> orders . name
                                    </li>
                                    <li class="list-group-item">
                                        <b> phone : </b>orders . phone
                                    </li>
                                    <li class="list-group-item">
                                        <b> address : </b> orders . address
                                    </li>
                                    <li class="list-group-item">
                                        <b> date : </b> orders . order_date
                                    </li>
                                    <li class="list-group-item">
                                        <b> pay_through : </b> orders . payBy
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table 2 -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                title
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b>sub_total :
                                        </b>orders . sub_total
                                    </li>
                                    <li class="list-group-item">
                                        <b>vat : </b>orders . vat %
                                    </li>
                                    <li class="list-group-item">
                                        <b>total :
                                        </b>orders . total
                                    </li>
                                    <li class="list-group-item">
                                        <b>pay_amount :
                                        </b>orders . pay
                                    </li>
                                    <li class="list-group-item">
                                        <b>due_amount :
                                        </b>orders . due
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Table 3 -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                ordered_products
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                product_name
                                            </th>
                                            <th>code</th>
                                            <th>
                                                image
                                            </th>
                                            <th>quantity</th>
                                            <th>unit_price</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr v-for="product in details" :key="product.id">
                                            <td>{{ product . product_name }}</td>
                                            <td>{{ product . product_code }}</td>
                                            <td>
                                                <img :src="product.image ?
                                                    product.image :
                                                    '/backend/img/none-img.jpg'"
                                                    id="image_size" />
                                            </td>
                                            <td>{{ product . product_quantity }}</td>
                                            <td>{{ number_format(product . product_price) }}</td>
                                            <td>{{ number_format(product . sub_total) }}</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </section>
@endsection
