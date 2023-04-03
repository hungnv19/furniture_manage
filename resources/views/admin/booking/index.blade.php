@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking List</h1>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Booking </h3>
                            <a class="btn btn-sm btn-primary" href="{{ route('booking.create') }}"
                                style="float: right;">Create</a>
                        </div>

                        <div class="card-body">
                            @if ($appointments->count() > 0)
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointments as $appointment)
                                            <tr>
                                                <td>
                                                    {{ $appointment->date }}
                                                </td>
                                                <td>
                                                    {{ $appointment->start_time }}
                                                </td>
                                                <td>
                                                    {{ $appointment->end_time }}
                                                </td>
                                                <td>
                                                    {{ $appointment->customer_name }}
                                                </td>
                                                @if ($appointment->status != 0)
                                                    <td class="text-success">
                                                        Processed
                                                    </td>
                                                @else
                                                    <td class="text-danger">
                                                        No process
                                                    </td>
                                                @endif
                                                <td>
                                                    {{ $appointment->note }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('booking.edit', $appointment->id) }}">Edit</a>
                                                    <form action="{{ route('booking.destroy', $appointment->id) }}"
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
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <data-empty></data-empty>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
