@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cart List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Cart</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">

        {{-- <cart-list :data="{{ json_encode([
            'pos' => $pos,
        ]) }}">
        </cart-list> --}}
        <div class="container-fluid">
            <div class="row row mb-3">
                <div class="col-xl-8 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Cart</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($pos->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pos as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->product_name }}
                                                    </td>
                                                    <td>

                                                        {{ $item->product_quantity }}
                                                    </td>
                                                    <td>
                                                        {{ $item->product_price }}

                                                    </td>
                                                    <td>
                                                        {{ $item->sub_total }}

                                                    </td>
                                                    <td>
                                                        <form action="{{ route('cart.destroy', $item->id) }}"
                                                            method="Post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4">
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
                                        <span class="text-muted">{{ $vat->vat }}%</span>
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

                                <form>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Customer</label>
                                        <select class=" form-select" name="customer" id="" type="text">
                                            <option disabled selected> Chose Customer </option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Pay By</label>
                                        <select class="form-control" id="exampleFormControlSelect2" name="payBy">
                                            <option value="handCash">Hand Cash</option>
                                            <option value="giftCard">Gift Card</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-success" type="submit">submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
