@extends('admin.welcome')
@section('content')
    <section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0 align-items-center">
            <div class="col-12">
            <h2 class="font-weight-bold mb-3">{{__('translations.shoppingCarts.index.shoppingCarts')}}</h2>
                <table id="shoppingCartsTable"class="responsive-table-lg table table-striped mt-3 text-center table-hover"> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translations.shoppingCarts.index.ownershoppingCart')}}</th>
                        <th>{{__('translations.shoppingCarts.index.statusshoppingCart')}}</th>
                        <th>{{__('translations.shoppingCarts.index.created_at')}}</th>
                        <th>{{__('translations.shoppingCarts.index.updated_at')}}</th>
                        <th>{{__('translations.shoppingCarts.index.details')}}</th>
                        <th>{{__('translations.shoppingCarts.index.delete')}}</th>
                    </tr>
                    </thead>

                    
                </table>
            </div>
    </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
    let translate = ["{{__('translations.shoppingCarts.index.ownershoppingCart')}}",
                        "{{__('translations.shoppingCarts.index.statusshoppingCart')}}",
                        "{{__('translations.shoppingCarts.index.created_at')}}",
                        "{{__('translations.shoppingCarts.index.updated_at')}}",
                        "{{__('translations.shoppingCarts.index.details')}}",
                        "{{__('translations.shoppingCarts.index.delete')}}"
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
            },
            drawCallback: function (setting) {
                    deleteButton();
                },
            });
        });
        function deleteButton() {
        $(document).ready(function() {
        $("[data-delete-href]").click(function() {
            var url = $(this).data("delete-href");
            bootbox.confirm({
                title: `Czy chcesz usunąć ?`,
                message: `<div class="modal-icon"><i class="far fa-trash-alt mr-1"></i><span>Czy chcesz usunąć ten koszyk?</span></div>`,
                buttons: {
                    confirm: {
                        label: `<i class="fa fa-check mr-1"></i> Usuń`,
                        className: 'btn-danger',
                    },
                    cancel: {
                        label: `<i class="fa fa-times mr-1"></i>Zamknij`,
                        className: 'back',
                    },
                },
                centerVertical: true,
                callback: function(confirm) {
                    if( confirm ) {
                        $.ajax({
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'DELETE',
                            success: function(result) {
                                bootbox.alert({
                                    title: `Usunięto`,
                                    message: `<div class="modal-icon"><i class="fa fa-check text-success"></i><span>Usunięto</span></div>`,
                                    centerVertical: true,
                                    callback: function(confirm) {
                                        $(location).attr("href", 'shoppingCarts');
                                    },
                                });
                            },
                            error: function() {
                                bootbox.alert({
                                    title: `Nie usunięto`,
                                    message: `<div class="modal-icon"><i class="fa fa-times text-danger"></i><span>Nie usunięto</span></div>`,
                                    centerVertical: true,
                                });
                            },
                        });
                    }
                }
            });
        })
    });
}
</script>
@endsection