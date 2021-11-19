@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
    <div class="row m-0 p-0">
        <div class="col-xl-8 offset-xl-2 text-center text-xl-left">
            <a class="btn back mb-5" href={{route('product.index')}}>{{__('translation.products.create.back')}}</a>
            <h2 class="font-weight-bold text-center mb-3">Szczegóły</h2>
            <img width="350" class="float-xl-right mt-xl-4 img-fluid mt-2" src="{{$product->image}}">
            <div class="mt-xl-5">
                <h4>Nazwa produktu: {{$product->name}}</h4>
                <h5>Cena produktu: {{$product->unit_price}}</h5>
                <h5>Stan magazynowy produktu: {{$product->stock_status}}</h5>
                <h5>Kategoria produktu: {{isset($product->category->category_name) ? $product->category->category_name : 'Dotychczasową kategorię usunięto edytuj produkt aby nadać mu jedną z istniejących'}}</h5>
                <h5>Opis produktu: {{$product->description}}</h5>
            </div>
        </div>
    </div>
</section>
@endsection
