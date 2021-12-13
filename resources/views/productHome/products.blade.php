@extends('welcome')
@section('carusel')
<div class="container-fluid">
    <div class="row p-0 m-0">
        <div id="carouselExampleIndicators" class="carousel slide col-10 offset-1" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 h-50" src="{{asset('/storage/baner9.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-50" src="{{asset('/storage/baner5.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-50" src="{{asset('/storage/baner7.png')}}" alt="Third slide">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection
@section('content')
    <section class="container text-center">
        <div class="row m-0 p-0 py-3 col-12 justify-content-center">
            @foreach($categories as $key => $category)
                <a class="btn mr-3 mb-3 text-white" href="{{route('product.index_all_category',['category' => $category->category_name])}}"  style="background-color: #05742a;">{{$category->category_name}}</a>
            @endforeach
        </div>
        <div class="row m-0 text-center">
            @foreach($products as $key => $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                <a href="#" class="my-1 text-dark text-decoration-none">
                    <img class="card-img-top" src="{{asset($product->image)}}" alt="Card image cap">
                </a>
                <div class="card-body">
                    <a href="{{route('product.details', ['product' => $product])}}" class="my-1 text-dark text-decoration-none">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                    </a>
                    @if(Auth::check() && Auth::user()->hasRole('user'))
                    <form action="{{route('store_productClient')}}" method="POST">
                        @csrf
                        <input type="hidden" class="text-center col-1"  value="1" name="quantity"></br>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit" class="btn px-5 mt-2 text-white" @if($product->stock_status < 1) disabled  @endif style="background-color: #05742a;">Dodaj do koszyka</button>
                    </form>
                    @endif
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
