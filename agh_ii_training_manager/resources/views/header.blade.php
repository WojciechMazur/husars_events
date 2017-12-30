<header style="position: relative">
    <div id="logo">
        @include('utils.logo')
    </div>

    <div class="container">
        @if(!\Illuminate\Support\Facades\Auth::guest())
            <div class="message-bar">
                <span id =message-text></span>
            </div>
        @endif
        <span id="shopping-cart">
                <a href="{{route('shop.shopping-cart')}}" id="shopping-cart-items">
                    Shopping Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    {{Session::has('shopping-cart') ? Session::get('shopping-cart')->totalQuantity : ''}}
                </a>
                </span>

        @if(Auth::guest())
            @include('utils.login_form')
        @else
           <span id="user-profile">
           <a href="{{route('profile.show', ['id' => encrypt(\Illuminate\Support\Facades\Auth::id())])}}">
                Profile <i class="fa fa-user" aria-hidden="true"></i></a>
           </span>
            <form id="logout-form" class="form-horizontal" action="{{ route('logout') }}" method="POST">
                    <span id="logout-label">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                        {{ csrf_field() }}
                    </a>
                    </span>
            </form>
        @endif

    </div>

</header>