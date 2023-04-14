@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Booking</a></li>
                        <li class="breadcrumb-item"><a href="">Create</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <booking-create
            :data="{{ json_encode([
                'urlStore' => route('booking.store'),
                'urlBack' => route('booking.index'),
                'customers' => $customers,
            ]) }}">
        </booking-create>
    </section>
@endsection
