@extends('admin.welcome')
@section('content')
    <section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0 align-items-center">
            <div class="col-12">
            <h2 class="font-weight-bold mb-3">{{__('translation.shoppingCarts.index.shoppingCarts')}}</h2>
                <table id="shoppingCartsTable"class="responsive-table-lg table table-striped mt-3 text-center table-hover"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translation.shoppingCarts.index.ownershoppingCart')}}</th>
                        <th>{{__('translation.shoppingCarts.index.statusshoppingCart')}}</th>
                        <th>{{__('translation.shoppingCarts.index.created_at')}}</th>
                        <th>{{__('translation.shoppingCarts.index.updated_at')}}</th>
                        <th>{{__('translation.shoppingCarts.index.details')}}</th>
                        <th>{{__('translation.shoppingCarts.index.delete')}}</th>
                    </tr>
                    </thead>

                    
                </table>
            </div>
    </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
    let translate = ["{{__('translation.shoppingCarts.index.ownershoppingCart')}}",
                        "{{__('translation.shoppingCarts.index.statusshoppingCart')}}",
                        "{{__('translation.shoppingCarts.index.created_at')}}",
                        "{{__('translation.shoppingCarts.index.updated_at')}}",
                        "{{__('translation.shoppingCarts.index.details')}}",
                        "{{__('translation.shoppingCarts.index.delete')}}"
                        ];
        $(document).ready(function() {
            $('#shoppingCartsTable').DataTable({
                processing: true, // wyświetlanie komunikatu o przetwarzaniu
                serverSide: true, // przetwarzanie po stronie serwera
                autoWidth: false,
                ajax: {
                    url: '{!! route('shoppingCart.index') !!}',
                    type: 'GET',
                    // podczas wysyłania metodą POST koniecznie jest dodanie tokena
                    // zabezpieczającego przed atakami CSRF
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status_name',
                        name: 'status_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'details',
                        name: 'details',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    },
                ],
                createdRow: function(row, data, rowIndex){
                $.each($('td', row), function(index){
                    $(this).attr('data-name',translate[index]);
                });
                }
            });
        });
    </script>
@endsection

