@extends('layout.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Expense</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <expense-edit
            :data="{{ json_encode([
                'urlUpdate' => route('expense.update', $expense->id),
                'urlBack' => route('expense.index'),
                'expense' => $expense,
            ]) }}">
        </expense-edit>
    </section>
@endsection
