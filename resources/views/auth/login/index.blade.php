@extends('layout.client')
@section('content')
    <section class="content">

        <login-form
            :data="{{ json_encode([
                'urlStore' => route('login.store'),
                'urlBack' => route('home'),
                'urlRegister' => route('register.create'),
                'urlUserLogin' => route('login.checkUserLogin'),
            ]) }}">
        </login-form>
    </section>
@endsection
