@extends('admin.welcome')
@section('content')
    <section class="container-fluid my-5 dashboard">
        <div class="row m-0 p-0">
            <div class="col-12">
            <h2 class="font-weight-bold">{{__('translation.categories.index.categories')}}</h2>
            <a class="btn back text-white mt-3 mb-5" href={{route('category.create')}}>{{__('translation.categories.create.addCategory')}}</a>
                <table id="categoryTable" class="table table-striped mt-5 table-hover text-center responsive-table-lg ">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th>{{__('translation.categories.index.id')}}</th>
                        <th>{{__('translation.categories.index.categoryName')}}</th>
                        <th>{{__('translation.categories.index.img')}}</th>
                        <th>{{__('translation.categories.index.created_at')}}</th>
                        <th>{{__('translation.categories.index.deleted_at')}}</th>
                        <th>{{__('translation.categories.index.edit')}}</th>
                        <th>{{__('translation.categories.index.delete')}}</th>
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
        "{{__('translation.categories.index.id')}}",
        "{{__('translation.categories.index.categoryName')}}",
        "{{__('translation.categories.index.img')}}",
        "{{__('translation.categories.index.created_at')}}",
        "{{__('translation.categories.index.deleted_at')}}",
        "{{__('translation.categories.index.edit')}}",
        "{{__('translation.categories.index.delete')}}"
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
                }
            });
        });
    </script>
@endsection

