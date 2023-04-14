@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking Edit</h1>
                    <a class="btn btn-sm btn-primary" href="{{ route('booking.calendar') }}"
                    style="float: right;">calendar</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Booking</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <booking-edit
            :data="{{ json_encode([
                'appointment' => $appointment,
                'urlUpdate' => route('booking.update', $appointment->id),
                'urlBack' => route('booking.index'),
                'customers' => $customers,
            ]) }}">
        </booking-edit>

    </section>
@endsection
