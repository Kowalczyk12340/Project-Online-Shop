@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0">
            <div class="col-12">
                <a class="btn back mb-5"  @if($shoppingCart->status_cart_id == 1) href={{route('shoppingCart.index_orders')}} @else href={{route('shoppingCart.index')}} @endif>{{__('translations.products.create.back')}}</a>
                <h2 class="font-weight-bold mb-3">{{'Produkty z koszyka'}}</h2>
                <table class="table table-striped mt-5 text-center vertical-align-middle table-hover"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translations.products.index.productName')}}</th>
                        <th>{{__('translations.products.index.productCategory')}}</th>
                        <th>{{__('translations.products.index.img')}}</th>
                        <th>{{__('translations.products.index.productUnitPrice')}}</th>
                        <th>{{__('translations.products.index.productQuantity')}}</th>
                        <th>{{__('translations.products.index.productsSum')}}</th>
                        <th>{{__('translations.products.index.details')}}</th>
                        <th>{{__('translations.products.index.edit')}}</th>
                        <th>{{__('translations.products.index.delete')}}</th>
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
                            <td class="align-middle">{{number_format($product->quantity,0)}} szt.</td>
                            <td class="align-middle">{{$product->sell_price}} zł</td>
                            <td class="align-middle"><a class="btn btn-info text-white" href="{{route('shoppingCart.product_details', ['product' => $product])}}">{{'Szczegóły'}}</a></td>
                            @if($product->deleted_at == null && $shoppingCart->status_cart_id == 2)
                            <td class="align-middle">
                                <a class="btn btn-warning text-black" href="{{route('shoppingCart.edit_product', ['q' => $product->pivot->quantity, 'shoppingCart' =>$shoppingCart ,'product' => $product])}}">{{__('translations.products.index.edit')}}</a>
                            </td>
                            <td class="align-middle">
                                <form method="post" action="{{route('shoppingCart.delete_product', ['shoppingCart' =>$shoppingCart ,'product' => $product])}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger text-white" type="submit">{{__('translations.products.index.delete')}}</button>
                                </form>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                        
                    <tfoot>
                        <tr>
                            <td class="text-left font-weight-bold back" style="opacity:0.8;" colspan="5">
                                {{'Razem'}}
                            </td>
                            <td class="font-weight-bold back" colspan="4">
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