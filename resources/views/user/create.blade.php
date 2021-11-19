@extends('admin.welcome')
@section('content')
<section class="container m-5 dashboard">
    <a class="btn btn-dark mb-5" href={{route('user.index')}}>{{__('translation.users.create.back')}}</a> 
        <h2 class="font-weight-bold">@if($edit) {{__('translation.products.create.editProduct')}} @else {{__('translation.products.create.addProduct')}} @endif</h2>
            <div class="row m-0 p-0">
                <form method="post" @if($edit) action="{{route('user.update', ['user' => $user])}}" @else action="{{route('user.store')}}" @endif enctype="multipart/form-data">
                    @csrf
                    @if($edit) @method('put') @endif
                    <div class="form-group">
                        <label for="name" class="form-check-label pb-2">Imię*</label>
                        <input class="form-control" type="text" id="name" name="name" @if($edit) value="{{$user->name}}"@endif placeholder="{{'Podaj imię'}}">
                    </div>
                    <div class="form-group">
                        <label for="surname" class="form-check-label pb-2">Nazwisko*</label>
                        <input class="form-control" type="text" id="surname" name="surname" @if($edit) value="{{$user->surname}}"@endif placeholder="{{'Podaj nazwisko'}}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-check-label pb-2">Email*</label>
                        <input class="form-control" type="text" id="email" name="email" @if($edit) value="{{$user->email}}"@endif placeholder="{{'Podaj email'}}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-check-label pb-2">Hasło*</label>
                        <input class="form-control" type="password" id="password" name="password" @if($edit) value="{{$user->email}}"@endif placeholder="{{'Podaj email'}}">
                    </div>
                    <div class="form-group">
                        <label for="photo" class="form-check-label pb-2">Zdjęcie profilowe</label>
                        <input class="form-control" type="file" id="photo" name="photo" @if($edit) value="{{$user->photo}}"@endif placeholder="{{'Dodaj zdjęcie'}}">
                        @if($edit)<img class="mt-2 image-fluid w-25 h-25" src="{{$user->photo}}">@endif
                    </div>
                    <div class="form-group">
                        <label for="role" class="form-check-label pb-2">Kategoria produktu</label>
                        <select class="form-control" id="role" name="role" @if($edit) value="{{$user->role}}"@endif placeholder="{{'Podaj nazwę produktu'}}">
                            @foreach($roles as $role)
                                <option @if($edit && $role->id == $user->role) selected @endif value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="street" class="form-check-label pb-2">Ulica</label>
                        <input class="form-control" type="text" id="street" name="street" @if($edit) value="{{$user->street}}"@endif placeholder="{{'Podaj ulicę'}}">
                    </div>
                    <div class="form-group">
                        <label for="house_number" class="form-check-label pb-2">Numer domu</label>
                        <input class="form-control" type="text" id="house_number" name="house_number" @if($edit) value="{{$user->house_number}}"@endif placeholder="{{'Podaj numer domu'}}">
                    </div>
                    <div class="form-group">
                        <label for="apartment_number" class="form-check-label pb-2">Numer lokalu</label>
                        <input class="form-control" type="text" id="apartment_number" name="apartment_number" @if($edit) value="{{$user->apartment_number}}"@endif placeholder="{{'Podaj numer lokalu'}}">
                    </div>
                    <div class="form-group">
                        <label for="postcode" class="form-check-label pb-2">Kod pocztowy</label>
                        <input class="form-control" type="text" id="postcode" name="postcode" @if($edit) value="{{$user->postcode}}"@endif placeholder="{{'Podaj kod pocztowy'}}">
                    </div>
                    <div class="form-group">
                        <label for="town" class="form-check-label pb-2">Miejscowość</label>
                        <input class="form-control" type="text" id="town" name="town" @if($edit) value="{{$user->town}}"@endif placeholder="{{'Podaj miejscowość'}}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-check-label pb-2">Numer telefonu</label>
                        <input class="form-control" type="text" id="phone_number" name="phone_number" @if($edit) value="{{$user->phone_number}}"@endif placeholder="{{'Podaj numer telefonu'}}">
                    </div>
                    <button type="sumbit" class="btn btn-success">{{__('translation.categories.create.save')}}</button>
                </form>
            </div>
    </section>
@endsection