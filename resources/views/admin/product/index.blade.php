@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Product</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>

                                            <td>
                                                {{ $product->id }}

                                            </td>
                                            <td>
                                                {{ $product->category_id }}

                                            </td>
                                            <td>
                                                {{ $product->product_name }}

                                            </td>
                                            <td>
                                                {{ $product->product_code }}

                                            </td>
                                            <td>
                                                {{ $product->root }}

                                            </td>
                                            <td>
                                                {{ $product->buying_price }}

                                            </td>
                                            <td>
                                                {{ $product->selling_price }}

                                            </td>
                                            <td>
                                                {{ $product->buying_date }}

                                            </td>
                                            <td>
                                                {{ $product->image }}

                                            </td>
                                            <td>
                                                {{ $product->product_quantity }}

                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                <form action="{{ route('product.destroy', $product->id) }}"
                                                    method="Post" style="display: inline-block; margin-left: 10px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
