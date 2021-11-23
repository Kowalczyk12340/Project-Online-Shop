@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
    <div class="row m-0 p-0">
        <div class="col-12">
        <h2 class="font-weight-bold mb-3">{{"Zamówienia"}}</h2>
        <table id="orderTable" class="responsive-table-lg table table-striped mt-3 text-center table-hover">
            <thead class="bg-dark text-white">
                <tr>
                    <th>{{'Imię i nazwisko'}}</th>
                    <th>{{'Status'}}</th>
                    <th>{{'Utworzony'}}</th>
                    <th>{{__('translations.shoppingCarts.index.details')}}</th>
                </tr>
            </thead> 
        </table>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script type="text/javascript">
    let translate = [
                        "{{'Imię i nazwisko'}}",
                        "{{'Status'}}",
                        "{{'Utworzony'}}",
                        "{{__('translations.shoppingCarts.index.details')}}"
    ];
        $(document).ready(function() {
            $('#orderTable').DataTable({
                processing: true, // wyświetlanie komunikatu o przetwarzaniu
                serverSide: true, // przetwarzanie po stronie serwera
                autoWidth: false,
                ajax: {
                    url: '{!! route('shoppingCart.index_orders') !!}',
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
                        data: 'details',
                        name: 'details',
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
