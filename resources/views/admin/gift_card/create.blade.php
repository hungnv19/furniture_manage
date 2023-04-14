@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gift Card Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Gift Card</a></li>
                        <li class="breadcrumb-item"><a href="">Create</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <gift-card-create
            :data="{{ json_encode([
                'urlStore' => route('gift-card.store'),
                'urlGetCode' => route('gift-card.code'),
                'urlBack' => route('gift-card.index'),
            ]) }}">
        </gift-card-create>
    </section>
@endsection
