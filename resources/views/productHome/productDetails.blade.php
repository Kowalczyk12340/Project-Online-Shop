@extends('welcome')
@section('content')
<section class="container">
    <div class="row m-0">
            <img class="col-md-6 img-fluid float-left"  src="{{asset($product->image)}}">
            <div class="col-md-5 float-left my-auto">
                <h1 class="my-4 text-center font-weight-bold">Dane produktu</h1>
                <h2 class="mb-3 text-center">{{$product->name}}</h2>
                <p class="text-center">{{$product->description}}</p>
                <h3 class="text-center">Cena: {{$product->unit_price}} zł</h3>
                <p class="text-center">Dostępne sztuki: {{number_format($product->stock_status,0)}}</p>
                @if(Auth::check() && Auth::user()->hasRole('client'))
                <form class="mb-5 h-flex" action="{{route('store_productClient')}}" method="POST">
                    @csrf
                    <label class="col-2 col-sm-2  col-md-3" id="quantity">Ilość:</label>
                    <input class="text-center col-8 col-sm-7 col-md-8" type="text" name="quantity">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="btn py-2 px-sm-3 my-3 col-xs-2 col-sm-10 col-md-12 text-white font-weight-bold offset-md-0" @if($product->stock_status < 1) disabled @endif style="background-color: #05742a;">Dodaj do koszyka</button>
                </form>
                @endif
        </div>
    </div>
</section>
@endsection
