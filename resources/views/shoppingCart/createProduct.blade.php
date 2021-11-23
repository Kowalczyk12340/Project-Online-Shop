@extends('admin.welcome')
@section('content')
<section class="container m-5 dashboard d-flex justify-content-center">
    <div class="row m-0 p-0">
    <div class="col-12">
    <a class="btn btn-dark mb-5" href="{{url()->previous()}}">{{__('translations.products.create.back')}}</a> 
        <h2 class="font-weight-bold">@if($edit) {{__('translations.products.create.editProduct')}} @else {{__('translations.products.create.addProduct')}} @endif</h2>
                <form method="post" action="{{route('shoppingCart.store_product', ['shoppingCart' => $shoppingCart])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="product_id" class="form-check-label pb-2">Nazwa produktu</label>
                        <select class="form-control" id="product_id" name="product_id" @if($edit) value="{{$product->id}}"@endif placeholder="{{'Podaj nazwę produktu'}}">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name . "  " . $product->unit_price .'zł'}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="form-check-label pb-2">Ilość:</label>
                        <input class="form-control" type="text" id="quantity" name="quantity"  placeholder="{{'Podaj ilość'}}">
                    </div>
                    <button type="sumbit" class="btn btn-success">{{__('translations.categories.create.save')}}</button>
                </form>
            </div>
        </div>
    </section>
@endsection