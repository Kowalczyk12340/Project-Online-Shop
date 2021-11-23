@extends('welcome')
@section('content')
    <section class="container-fluid mt-5 dashboard d-flex justify-content-center">
        <div class="row m-0 p-0">
            <div class="col-sm-6 col-md-12">
            <h2 class="font-weight-bold mb-3">{{"Moje zamówienia"}}</h2>
                <table class="table table-striped mt-3 text-center table-hover table-responsive"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{'id'}}</th>
                        <th>{{'Imię i nazwisko'}}</th>
                        <th>{{'Status'}}</th>
                        <th>{{'Utworzony'}}</th>
                        <th>{{__('translations.shoppingCarts.index.details')}}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(count($shoppingCarts) == 0)
                        <tr>
                            <td colspan="5"> {{'Brak złożonych zamówień'}} </td>
                        </tr>
                    @else
                    @foreach($shoppingCarts as $key => $shoppingCart)
                        <tr>
                            <td class="align-middle">{{$key+1}}</td>
                            <td class="align-middle">{{$shoppingCart->user->name .' '. $shoppingCart->user->surname . ' ('.$shoppingCart->user->email.')'}}</td>
                            <td class="align-middle">{{$shoppingCart->statusCart->status_name}}</td>
                            <td class="align-middle">{{$shoppingCart->created_at}}</td>
                            <td class="align-middle"><a class="btn btn-info text-white" href="{{route('showClientCart', ['shoppingCart' => $shoppingCart])}}">{{'Szczegóły'}}</a></td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
@endsection
