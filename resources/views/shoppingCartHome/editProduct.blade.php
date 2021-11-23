@extends('welcome')
@section('content')
<section class="container">
<div class="row m-0 p-0 col-12">
    <a class="btn btn-dark my-5 offset-col-6 col-2 mx-5 justify-content-start" href="{{url()->previous()}}">{{__('translations.products.create.back')}}</a> 

<div class="col-12">
        <h2 class="font-weight-bold ml-5 mb-4">@if($edit) {{__('translations.products.create.editProduct')}} @else {{__('translations.products.create.addProduct')}} @endif</h2>
                <form class="ml-5 mb-3" method="post" @if($edit) action="{{route('update_productClient', ['shoppingCartProd' => $shoppingCartProd[0]])}}" @else action="{{route('shoppingCart.store_product')}}" @endif enctype="multipart/form-data">
                    @csrf
                    @if($edit) @method('put') @endif
                    <div class="form-group">
                        <label for="name" class="form-check-label pb-2">Nazwa produktu: @if($edit) {{$product->name}}@endif</label>
                        @if(!$edit) <input class="form-control" type="text" id="name" name="name"  placeholder="{{'Podaj nazwę produktu'}}">@endif
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-check-label pb-2">Zdjęcie produktu</label>
                        @if($edit)<img class="mt-2 image-fluid" style="width:100px; height:100px;" src="{{$product->image}}">@endif
                    </div>
                    <div class="form-group">
                        <label for="unit_price" class="form-check-label pb-2">Cena produktu: @if($edit) {{$product->unit_price}} zł@endif</label>
                        @if(!$edit)<input class="form-control" type="text" id="unit_price" name="unit_price"  placeholder="{{'Podaj cenę produktu'}}">@endif
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-check-label pb-2">Opis produktu: @if($edit){{$product->description}}@endif</label>
                        @if(!$edit)<textarea class="form-control" type="text" id="description" name="description"  placeholder="{{'Podaj opis produktu'}}"></textarea>@endif
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="form-check-label pb-2">Ilość:</label>
                        @if($edit)<input class="form-control col-4" type="text" id="quantity" name="quantity" value="{{number_format($q,2)}}"  placeholder="{{'Podaj ilość'}}">  @endif
                    </div>
                    <button type="sumbit" class="btn btn-success">{{__('translations.categories.create.save')}}</button>
                </form>
        </div>
        </div>
    </section>
@endsection