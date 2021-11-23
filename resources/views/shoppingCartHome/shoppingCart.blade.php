@extends('welcome')
@section('content')
<section class="container">
    <div class="row p-0 m-0 col-12 justify-content-center">
            <div class="col-12">
                <h1 class="my-4 mx-5 font-weight-bold">Dane koszyka</h1>
                <h5 class="mx-5"><span class="font-weight-bold">Imię, nazwisko:</span> {{$shoppingCarts->user->name .' '. $shoppingCarts->user->surname}}</h5>
                <h5 class="mx-5"><span class="font-weight-bold">Email: </span>{{$shoppingCarts->user->email}}</h5>
                <h5 class="mx-5"><span class="font-weight-bold">Status: </span>{{$shoppingCarts->statusCart->status_name}}</h5>
                <h5 class="mx-5"><span class="font-weight-bold">Razem: </span>{{number_format($shoppingCarts->total_price,2)}} zł</h5>
                <table class="table table-striped mt-5 ml-5 text-center vertical-align-middle table-hover table-responsive"> 
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
                    @php $sum = 0  @endphp
                    <tbody>
                    @if(count($shoppingCarts->products) != 0)
                    @foreach($shoppingCarts->products as $key => $product)
                        <tr>
                            <td class="align-middle">{{$product->name}}</td>
                            <td class="align-middle">{{isset($product->category->category_name) ? $product->category->category_name : 'Dotychczasową kategorię usunięto edytuj produkt aby nadać mu jedną z istniejących' }}</td>
                            <td class="align-middle"><img src="{{$product->image}}" style="height:50px; width:50px;"></td>
                            <td class="align-middle">{{$product->unit_price}} zł</td>
                            <td class="align-middle">{{number_format($product->pivot->quantity,0)}} szt.</td>
                            <td class="align-middle">{{number_format($product->pivot->sell_price,2)}} zł</td>
                            <td class="align-middle"><a class="btn btn-info text-white" href="{{route('product.details', ['product' => $product])}}">{{'Szczegóły'}}</a></td>
                            @if($product->deleted_at == null)
                            <td class="align-middle">
                                <a class="btn btn-warning text-black" href="{{route('edit_productClient', ['q' => $product->pivot->quantity, 'shoppingCart' =>$shoppingCarts ,'product' => $product])}}">{{__('translations.products.index.edit')}}</a>
                            </td>
                            <td class="align-middle">
                                <form method="post" action="{{route('delete_productClient', ['shoppingCart' =>$shoppingCarts ,'product' => $product])}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger text-white" type="submit">{{__('translations.products.index.delete')}}</button>
                                </form>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            @php $sum += $product->pivot->sell_price @endphp
                        </tr>
                    @endforeach
                    </tbody>
                        
                    <tfoot>
                        <tr>
                            <td class="text-left font-weight-bold bg-success" style="color:#000; opacity:0.8;" colspan="5">
                                {{'Razem'}}
                            </td>
                            <td class="bg-success font-weight-bold" colspan="4" style="color:#000;">
                                {{number_format($shoppingCarts->total_price,2) .' zł'}}
                            </td>
                        </tr>
                    </tfoot>
                    @else
                    <td colspan="9">{{'Brak produktów w koszyku'}}</td>
                    @endif
                </table>
                @if(count($shoppingCarts->products) != 0)
                <form class="col-12" action="{{route('pay', ['shoppingCart' => $shoppingCarts])}}" method="post">
                    @csrf
                    <button class="btn bg-danger px-5 py-2 text-white mb-4 col-6 col-sm-4 justify-content-ceneter text-center offset-5 offset-lg-4" type="submit">Zapłać</button>
                </form>
                @endif
            </div>
    </div>
    </section>


@endsection