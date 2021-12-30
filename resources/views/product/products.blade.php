@extends('admin.welcome')
@section('content')
    <section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0">
            <div class="col-12">
            <h2 class="font-weight-bold mb-3">{{__('translations.products.index.products')}}</h2>
                <a class="btn text-white mb-5 back" href={{route('product.create')}}>{{__('translations.products.create.addProduct')}}</a>
                <table id="productTable" class="responsive-table-lg table table-striped mt-5 text-center table-hover "> 
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th>{{__('translations.products.index.id')}}</th>
                        <th>{{__('translations.products.index.productName')}}</th>
                        <th>{{__('translations.products.index.productCategory')}}</th>
                        <th>{{__('translations.products.index.productUnitPrice')}}</th>
                        <th>{{__('translations.products.index.productStockStatus')}}</th>
                        <th>{{__('translations.products.index.created_at')}}</th>
                        <th>{{__('translations.products.index.deleted_at')}}</th>
                        <th>{{__('translations.products.index.details')}}</th>
                        <th>{{__('translations.products.index.edit')}}</th>
                        <th>{{__('translations.products.index.delete')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
    </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
    let translate = ["{{__('translations.products.index.id')}}",
        "{{__('translations.products.index.productName')}}",
        "{{__('translations.products.index.productCategory')}}",
        "{{__('translations.products.index.productUnitPrice')}}",
        "{{__('translations.products.index.productStockStatus')}}",
        "{{__('translations.products.index.created_at')}}",
        "{{__('translations.products.index.deleted_at')}}",
        "{{__('translations.products.index.details')}}",
        "{{__('translations.products.index.edit')}}",
        "{{__('translations.products.index.delete')}}" ];
        $(document).ready(function() {
            $('#productTable').DataTable({
                processing: true, // wyświetlanie komunikatu o przetwarzaniu
                serverSide: true, // przetwarzanie po stronie serwera
                autoWidth: false,
                ajax: {
                    url: '{!! route('product.index') !!}',
                    type: 'GET',
                    // podczas wysyłania metodą POST koniecznie jest dodanie tokena
                    // zabezpieczającego przed atakami CSRF
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'unit_price',
                        name: 'unit_price'
                    },
                    {
                        data: 'stock_status',
                        name: 'stock_status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'deleted_at',
                        name: 'deleted_at'
                    },
                    {
                        data: 'show',
                        name: 'show',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'edit',
                        name: 'edit',
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
                message: `<div class="modal-icon"><i class="far fa-trash-alt mr-1"></i><span>Czy chcesz usunąć ten produkt?</span></div>`,
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
                                        $(location).attr("href", 'products');
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