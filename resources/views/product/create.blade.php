@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
    <div class="row m-0 p-0">
        <div class="col-12">
            <a class="btn back mx-lg-5 mb-5" href={{route('product.index')}}>{{__('translation.products.create.back')}}</a>
            <div class="card cardBox mx-lg-5">
                <div class="card-header bg-dark text-white">
                    <h2 class="font-weight-bold">@if($edit) {{__('translation.products.create.editProduct')}} @else {{__('translation.products.create.addProduct')}} @endif</h2>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="productForm" method="post" @if($edit) action="{{route('product.update', ['product' => $product])}}" @else action="{{route('product.store')}}" @endif enctype="multipart/form-data">
                        @csrf
                        @if($edit) @method('put') @endif
                        <div class="form-group">
                            <label for="name" class="form-check-label pb-2">Nazwa produktu</label>
                            <input class="form-control" type="text" id="name" name="name" @if($edit) value="{{$product->name}}" @endif placeholder="{{'Podaj nazwę produktu'}}">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-check-label pb-2">Zdjęcie produktu</label>
                            <input class="form-control" type="file" id="image" name="image" @if($edit) value="{{$product->image}}" @endif placeholder="{{'Dodaj zdjęcie'}}">
                            @if($edit)<img class="mt-2 image-fluid w-25 h-25" src="{{$product->image}}">@endif
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="form-check-label pb-2">Kategoria produktu</label>
                            <select class="form-control" id="category_id" name="category_id" @if($edit) value="{{$product->category_id}}" @endif placeholder="{{'Podaj nazwę produktu'}}">
                                <option @if(!$edit) selected @endif value="">Brak</option>
                                @foreach($categories as $category)
                                <option @if($edit && $category->id == $product->category_id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit_price" class="form-check-label pb-2">Cena produktu</label>
                            <input class="form-control" type="text" id="unit_price" name="unit_price" @if($edit) value="{{$product->unit_price}}" @endif placeholder="{{'Podaj cenę produktu'}}">
                        </div>
                        <div class="form-group">
                            <label for="stock_status" class="form-check-label pb-2">Stan magazynowy produktu</label>
                            <input class="form-control" type="text" id="stock_status" name="stock_status" @if($edit) value="{{$product->stock_status}}" @endif placeholder="{{'Podaj stan magazynowy produktu'}}">
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-check-label pb-2">Opis produktu</label>
                            <textarea class="form-control" type="text" id="description" name="description" placeholder="{{'Podaj opis produktu'}}">@if($edit){{$product->description}}@endif</textarea>
                        </div>
                        <button type="sumbit" class="btn send">{{__('translation.categories.create.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{{-- Walidacja po stronie klienta z użyciem reguł walidacji po stronie serwera --}}
{!! JsValidator::formRequest('App\Http\Requests\Product\ProductRequest', '#productForm'); !!}
@endsection
