@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
    <div class="row m-0 p-0">
        <div class="col-xl-8 offset-xl-2 text-center text-xl-left">
            <a class="btn back mb-5" href={{route('user.index')}}>{{__('translations.products.create.back')}}</a>
            <h2 class="font-weight-bold text-center mb-3">Szczegóły</h2>
            <div class="mt-xl-5">
                <h4>Id: {{$user->id}}</h4>
                <h4>Imię i Nazwisko: {{$user->name}}</h4>
                <h5>Email: {{$user->email}}</h5>
                <h5>Rola: {{$roles->first()->name}}</h5>
                <h5>Stworzony: {{ $user->created_at }}</h5>
                <h5>Zweryfikowany: {{ $user->email_verified_at }}</h5>
            </div>
        </div>
    </div>
</section>
@endsection