<nav id="sidebar-left" class="navbar navbar-expand-md p-0 flex-md-column">
  <a class="navbar-brand m-3">język</a>
  <button class="navbar-toggler navbar-light ml-auto py-0 m-3" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav flex-column ">
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['product.index', 'product.create', 'product.edit']) ? 'active' : '' }}" >
              <a class="nav-link" href="{{route('product.index')}}">
                  <i class="fas fa-cube inline-block"></i>{{'Produkty'}}
              </a>
          </li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['category.index', 'category.create', 'category.edit']) ? 'active' : '' }}">
              <a class="nav-link" href="{{route('category.index')}}">
                  <i class="fab fa-buffer"></i>{{'Kategorie'}}
              </a>
          </li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['shoppingCart.index', 'shoppingCart.create', 'shoppingCart.edit']) ? 'active' : '' }}">
              <a class="nav-link" href="{{route('shoppingCart.index')}}">
                  <i class="fas fa-shopping-basket"></i>{{'Koszyki'}}
              </a>
          </li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), []) ? 'active' : '' }}">
              <a class="nav-link" href="{{route('shoppingCart.index_orders')}}">
                  <i class="fas fa-luggage-cart"></i>{{'Zamówienia'}}
              </a>
          </li>
          <li class="nav-item {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('user.index')}}">
                <i class="fa fa-user"></i> @lang('Users')
            </a>
        </li>
          <li class="nav-item {{ Route::is('log-viewer::logs.list') ? 'active' : '' }}">
            <a href="{{ route('log-viewer::logs.list') }}" class="nav-link">
                <i class="fa fa-archive"></i> @lang('Logs')
            </a>
        </li>
          <li class="nav-item send">
              <a class="nav-link" href="http://localhost:8000/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                  <i class="fas fa-sign-out-alt"></i>{{'Wyloguj'}}
              </a>
          </li>
          <form id="logout-form" action="http://localhost:8000/logout" method="POST" class="d-none">
              @csrf         
          </form>
      </ul>
  </div>
</nav>