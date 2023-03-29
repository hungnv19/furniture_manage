@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gift Card Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Gift Card</a></li>
                        <li class="breadcrumb-item"><a href="#">Edit</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <gift-card-edit
            :data="{{ json_encode([
                'urlUpdate' => route('gift-card.update', $giftCard->id),
                'urlBack' => route('gift-card.index'),
                'giftCard' => $giftCard,
            ]) }}">
        </gift-card-edit>
    </section>
@endsection
