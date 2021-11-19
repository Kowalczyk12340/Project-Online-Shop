<nav class="navbar container-fluid navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('product.index_all')}}"><img style="width:100px; height:80px;" src="{{asset('storage/logo.png')}}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav d-flex justify-content-end w-100">
            <div class="">
                <a class="nav-link text-white mr-3 mt-2" href="{{route('product.index_all')}}"><i class="fas fa-swimmer"></i> Produkty <span class="sr-only">(current)</span></a>
            </div>
            <div class="">
            <ul class="navbar-nav">
                @role('client')
                <li class="nav-item mt-2">
                    <a class="nav-link text-white mr-3" href="{{route('shoppingCart.indexClient')}}"><i class="fas fa-shopping-cart inline-block"></i> Koszyk</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-white mr-3" href="{{route('index_ordersClient')}}"><i class="fas fa-luggage-cart"></i> Moje zamówienia</a>
                </li>
                @endrole
                @guest
                <li class="nav-item mt-2">
                <a class="btn mr-md-1 nav-link text-white" style="background-color: #05742a; border:#05742a;" href="{{route('login')}}">Zaloguj się</a>
                </li>
                <li class="nav-item mt-2">
                <a class="btn text-white nav-link" style="background-color: #05742a; border:#05742a;" href="{{route('register')}}">Zarejestruj się</a>
                </li>
                @endguest
                @auth
                <li class="nav-item mt-sm-2">
                    <div class="dropdown d-inline-block nav-link">
                        <button class="btn btn-light dropdown-toggle" style="background-color: #05742a; border: #05742a; color: white;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item btn text-dark" href="http://localhost:8000/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{'Wyloguj'}}
                            </a>
                            <form id="logout-form" action="http://localhost:8000/logout" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
