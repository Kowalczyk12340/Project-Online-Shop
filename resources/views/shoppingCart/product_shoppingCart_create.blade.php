@extends('admin.welcome')
@section('content')
<section class="container m-5 dashboard d-flex justify-content-center">
    <div class="row m-0 p-0">
        <div class="col-12">
        <a class="btn btn-dark mb-5" href={{route('shoppingCart.index')}}>{{__('translations.shoppingCarts.create.back')}}</a> 
            <h2 class="font-weight-bold">@if($edit) {{__('translations.shoppingCarts.create.editShoppingCart')}} @else {{__('translations.shoppingCarts.create.addShoppingCart')}} @endif</h2>
            <form method="post" @if($edit) action="{{route('shoppingCart.update', ['shoppingCart' => $shoppingCart])}}" @else action="{{route('shoppingCart.store')}}" @endif enctype="multipart/form-data">
                @csrf
                @if($edit) @method('put') @endif
                <div class="form-group">
                    <label for="product_id" class="form-check-label pb-2">Nazwa produktu</label>
                    <select class="form-control" id="product_id" name="product_id" @if($edit) value="{{$shoppingCart->product_id}}"@endif placeholder="{{'Podaj nazwę produktu'}}">
                        @foreach($products as $product)
                            <option @if($edit && $product->id == $shoppingCart->product_id) selected @endif value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image" class="form-check-label pb-2">Zdjęcie produktu</label>
                    <input class="form-control" type="file" id="image" name="image" @if($edit) value="{{$product->image}}"@endif placeholder="{{'Dodaj zdjęcie'}}">
                    @if($edit)<img class="mt-2 image-fluid w-25 h-25" src="{{$product->image}}">@endif
                </div>
                <div class="form-group">
                    <label for="unit_price" class="form-check-label pb-2">Cena produktu</label>
                    <input class="form-control" type="text" id="unit_price" name="unit_price" @if($edit) value="{{$product->unit_price}}"@endif placeholder="{{'Podaj cenę produktu'}}">
                </div>
                <div class="form-group">
                    <label for="stock_status" class="form-check-label pb-2">Stan magazynowy produktu</label>
                    <input class="form-control" type="text" id="stock_status" name="stock_status" @if($edit) value="{{$product->stock_status}}"@endif placeholder="{{'Podaj stan magazynowy produktu'}}">
                </div>
                <div class="form-group">
                    <label for="description" class="form-check-label pb-2">Stan magazynowy produktu</label>
                    <textarea class="form-control" type="text" id="description" name="description"  placeholder="{{'Podaj opis produktu'}}">@if($edit){{$product->description}}@endif</textarea>
                </div>
                <button type="sumbit" class="btn btn-success">{{__('translations.categories.create.save')}}</button>
            </form>
        </div>
    </div>
</section>
@endsection