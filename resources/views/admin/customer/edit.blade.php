@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customers Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item"><a href="#">Edit</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </section>



    <section class="content">
        <customer-edit
            :data="{{ json_encode([
                'urlCheckEmail' => route('register.checkMail'),
                'urlUpdate' => route('customer.update', $customer->id),
                'urlBack' => route('customer.index'),
                'customer' => $customer,
            ]) }}">
        </customer-edit>
    </section>
@endsection
