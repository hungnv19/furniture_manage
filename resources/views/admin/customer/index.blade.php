@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Customer </h3>
                            <a class="btn btn-sm btn-primary" href="{{ route('customer.create') }}"
                                style="float: right;">Create</a>
                        </div>

                        <div class="card-body">
                            @if ($customers->count() > 0)
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Photo</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>

                                                <td>
                                                    {{ $customer->id }}

                                                </td>
                                                <td>
                                                    {{ $customer->name }}

                                                </td>
                                                <td>
                                                    {{ $customer->email }}

                                                </td>
                                                <td>
                                                    {{ $customer->phone }}

                                                </td>
                                                <td>
                                                    {{ $customer->address }}

                                                </td>
                                                <td>
                                                    <img src=" {{ Storage::url($customer->photo) }}" style="width: 50px;" />
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('customer.edit', $customer->id) }}">Edit</a>

                                                    <form action="{{ route('customer.destroy', $customer->id) }}"
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
                            @else
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Photo</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <data-empty></data-empty>
                            @endif

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
