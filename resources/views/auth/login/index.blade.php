@extends('layout.client')
@section('content')
    <!-- Main content -->

    <section class="content">
        <h1 style="text-align: center">Login</h1>
        <login-form
            :data="{{ json_encode([
                'urlStore' => route('login.store'),
                'urlRegister' => route('register.create'),
            ]) }}">
        </login-form>
    </section>
@endsection
