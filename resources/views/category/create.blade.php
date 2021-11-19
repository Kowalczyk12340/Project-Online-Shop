@extends('admin.welcome')
@section('content')
<section class="container-fluid my-5 dashboard">
    <div class="row m-0 p-0">
        <div class="col-12">
            <a class="btn back mb-5 mx-lg-5" href={{route('category.index')}}>{{__('translation.categories.create.back')}}</a>
            <div class="card cardBox mx-lg-5">
                <div class="card-header bg-dark text-white">
                    <h2 class="font-weight-bold mb-0">@if($edit) {{__('translation.categories.create.editCategory')}} @else {{__('translation.categories.create.addCategory')}} @endif</h2>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="categoryForm" method="post" @if($edit) action="{{route('category.update', ['category' => $category])}}" @else action="{{route('category.store')}}" @endif enctype="multipart/form-data">
                        @csrf
                        @if($edit) @method('put') @endif
                        <div class="form-group">
                            <label for="category_name" class="form-check-label pb-2">Nazwa kategorii</label>
                            <input class="form-control" type="text" id="category_name" name="category_name" @if($edit) value="{{$category->category_name}}" @endif placeholder="{{'Wpisz kategorię'}}">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-check-label pb-2">Zdjęcie</label>
                            <input class="form-control" type="file" id="image" name="image" @if($edit) value="{{$category->image}}" @endif placeholder="{{'Dodaj zdjęcie'}}">
                        </div>
                        <button type="submit" class="btn send mt-2">{{__('translation.categories.create.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

@if(isset($edit) && $edit === true)
{!! JsValidator::formRequest('App\Http\Requests\Categories\UpdateCategoryRequest', '#categoryForm'); !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Categories\StoreCategoryRequest', '#categoryForm'); !!}
@endif
@endsection
