@extends('welcome')
@section('content')
<section class="container-fluid my-5 dashboard d-flex justify-content-center">
        <div class="row m-0 p-0">
            <div class="col-12">
                <a class="btn btn-dark mb-5"  @if($shoppingCart->status_cart_id == 1) href={{route('shoppingCart.index_orders')}} @else href={{route('shoppingCart.index')}} @endif>{{__('translations.products.create.back')}}</a>
                <h2 class="font-weight-bold mb-3">{{'Produkty z koszyka'}}</h2>
                <table id="shoppingCartDetailsClient" class="table table-striped mt-5 text-center vertical-align-middle table-hover table-responsive"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translations.products.index.productName')}}</th>
                        <th>{{__('translations.products.index.productCategory')}}</th>
                        <th>{{__('translations.products.index.img')}}</th>
                        <th>{{__('translations.products.index.productUnitPrice')}}</th>
                        <th>{{__('translations.products.index.productQuantity')}}</th>
                        <th>{{__('translations.products.index.productsSum')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($shoppingCart->products) != 0)
                    @foreach($shoppingCart->products as $key => $product)
                        <tr>
                            <td class="align-middle">{{$product->name}}</td>
                            <td class="align-middle">{{isset($product->category->category_name) ? $product->category->category_name : 'Dotychczasową kategorię usunięto edytuj produkt aby nadać mu jedną z istniejących' }}</td>
                            <td class="align-middle"> <img src="{{$product->image}}" style="height:50px; width:50px;"></td>
                            <td class="align-middle">{{$product->unit_price}} zł</td>
                            <td class="align-middle">{{number_format($product->pivot->quantity,0)}} szt.</td>
                            <td class="align-middle">{{$product->pivot->sell_price}} zł</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                        
                    <tfoot>
                        <tr>
                            <td class="text-left font-weight-bold bg-success" style="color:#000; opacity:0.8;" colspan="5">
                                {{'Razem'}}
                            </td>
                            <td class="bg-success font-weight-bold" style="color:#000;">
                                {{number_format($shoppingCart->total_price, 2) .' zł'}}
                            </td>
                        </tr>
                    </tfoot>
                    @else
                    <td colspan="9">{{'Brak produktów w koszyku'}}</td>
                    @endif
                </table>
            </div>
    </div>
    </section>
@endsection