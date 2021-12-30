@extends('admin.welcome')
@section('content')
    <section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0">
            <div class="col-12">
            <h2 class="font-weight-bold">{{__('translations.categories.index.categories')}}</h2>
            <a class="btn back text-white mt-3 mb-5" href={{route('category.create')}}>{{__('translations.categories.create.addCategory')}}</a>
                <table id="categoryTable" class="table table-striped mt-5 table-hover text-center responsive-table-lg ">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th>{{__('translations.categories.index.id')}}</th>
                        <th>{{__('translations.categories.index.categoryName')}}</th>
                        <th>{{__('translations.categories.index.img')}}</th>
                        <th>{{__('translations.categories.index.created_at')}}</th>
                        <th>{{__('translations.categories.index.deleted_at')}}</th>
                        <th>{{__('translations.categories.index.edit')}}</th>
                        <th>{{__('translations.categories.index.delete')}}</th>
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
        "{{__('translations.categories.index.id')}}",
        "{{__('translations.categories.index.categoryName')}}",
        "{{__('translations.categories.index.img')}}",
        "{{__('translations.categories.index.created_at')}}",
        "{{__('translations.categories.index.deleted_at')}}",
        "{{__('translations.categories.index.edit')}}",
        "{{__('translations.categories.index.delete')}}"
    ];
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                processing: true, // wyświetlanie komunikatu o przetwarzaniu
                serverSide: true, // przetwarzanie po stronie serwera
                autoWidth: false,
                ajax: {
                    url: '{!! route('category.index') !!}',
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
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'image',
                        name: 'image'
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
                message: `<div class="modal-icon"><i class="far fa-trash-alt mr-1"></i><span>Czy chcesz usunąć tą kategorię?</span></div>`,
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
                                        $(location).attr("href", 'categories');
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