<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__cart">
        <div class="offcanvas__cart__links">
            <a href="#" class="search-switch"><img src="{{asset('template/img/icon/search.png')}}" alt=""></a>
            @auth
            <a href="#"><img src="{{asset('template/img/icon/user.png')}}" alt=""></a>
            @endauth

            @guest
            <a href="#"><img src="{{asset('template/img/icon/heart.png')}}" alt=""></a>
            @endguest
        </div>
        <div class="offcanvas__cart__item">
            <a href="#"><img src="{{asset('template/img/icon/cart.png')}}" alt=""> <span>0</span></a>
            <div class="cart__price">Cart: <span>$0.00</span></div>
        </div>
    </div>
    <div class="offcanvas__logo">
        <a href="{{route('client-views.home')}}"><img src="{{asset('template/img/logo.png')}}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        <ul>
            <li>USD <span class="arrow_carrot-down"></span>
                <ul>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </li>
            <li>ENG <span class="arrow_carrot-down"></span>
                <ul>
                    <li>Spanish</li>
                    <li>ENG</li>
                </ul>
            </li>
            @auth
            <li><a href="{{route('logout.perform')}}">Log out</a> <span class="arrow_carrot-down"></span></li>
            @endauth

            @guest
            <li><a href="{{route('login.show')}}">Log in</a> <span class="arrow_carrot-down"></span></li>
            @endguest
        </ul>
    </div>
</div>