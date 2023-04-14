@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gift Card List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Gift Card</a></li>

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
                            <h3 class="card-title">All Gift Card</h3>
                            <a class="btn btn-sm btn-primary" href="{{ route('gift-card.create') }}"
                                style="float: right;">Create</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($giftCards->count() > 0)
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($giftCards as $giftCard)
                                            <tr>
                                                <td>
                                                    {{ $giftCard->code }}

                                                </td>
                                                <td>
                                                    {{ $giftCard->type }}

                                                </td>
                                                <td>
                                                    {{ number_format($giftCard->balance) . ' Đ' }}

                                                </td>
                                                @if ($giftCard->status == 0)
                                                    <td class="text-success">Active</td>
                                                @else
                                                    <td class="text-danger">Inactive</td>
                                                @endif

                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('gift-card.edit', $giftCard->id) }}">Edit</a>
                                                    <form action="{{ route('gift-card.destroy', $giftCard->id) }}"
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
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Balance</th>
                                            <th>Status</th>
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
