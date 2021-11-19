@extends('admin.welcome')
@section('content')
<section class="container m-5 dashboard d-flex justify-content-center">
    <div class="row m-0 p-0">
        <div class="col-12">
            <a class="btn btn-dark mb-5" href="{{url()->previous()}}">{{__('translation.products.create.back')}}</a> 
                <h2 class="font-weight-bold">@if($edit) {{__('translation.products.create.editProduct')}} @else {{__('translation.products.create.addProduct')}} @endif</h2>
                <form method="post" @if($edit) action="{{route('shoppingCart.update_product', ['shoppingCartProd' => $shoppingCartProd[0]])}}" @else action="{{route('shoppingCart.store_product')}}" @endif enctype="multipart/form-data">
                    @csrf
                    @if($edit) @method('put') @endif
                    <div class="form-group">
                        <label for="name" class="form-check-label pb-2">Nazwa produktu: @if($edit) {{$product->name}}@endif</label>
                        @if(!$edit) <input class="form-control" type="text" id="name" name="name"  placeholder="{{'Podaj nazwę produktu'}}">@endif
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-check-label pb-2">Zdjęcie produktu</label>
                        @if($edit)</br><img class="mt-2 image-fluid w-25 h-25" src="{{$product->image}}">@endif
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
                        @if($edit)<input class="form-control col-3" type="text" id="quantity" name="quantity" value="{{number_format($q,0)}}"  placeholder="{{'Podaj ilość'}}">  @endif
                    </div>
                    <button type="sumbit" class="btn btn-success">{{__('translation.categories.create.save')}}</button>
                </form>
            </div>
        </div>
    </section>
@endsection