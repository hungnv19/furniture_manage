@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Booking</a></li>
                        <li class="breadcrumb-item"><a href="#">Show</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <calendar-show></calendar-show>
    </section>
@endsection
