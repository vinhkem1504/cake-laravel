<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner">
                        <div class="header__top__left">
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
                                <li><a href="{{route('logout.perform')}}">Sign out</a> <span class="arrow_carrot-down"></span></li>
                                @endauth

                                @guest
                                <li><a href="{{route('login.show')}}">Sign In</a> <span class="arrow_carrot-down"></span></li>
                                <li><a href="{{route('register.show')}}">Register</a> <span class="arrow_carrot-down"></span></li>
                                @endguest
                            </ul>
                        </div>
                        <div class="header__logo">
                            <a href="{{route('client-views.home')}}"><img src="{{asset('template/img/logo.png')}}" alt=""></a>
                        </div>
                        <div class="header__top__right">
                            <div class="header__top__right__links">
                                <a href="#" class="search-switch"><img src="{{asset('template/img/icon/search.png')}}" alt=""></a>
                                @auth
                                <a href="{{route('client-views.user')}}"><img src="{{asset('template/img/icon/user.png')}}" alt=""></a>
                                <a href="{{route('client-views.user')}}"><p>{{auth()->user()->name}}</p></a>
                                @endauth

                                @guest
                                <a href="#"><img src="{{asset('template/img/icon/heart.png')}}" alt=""></a>
                                @endguest
                                
                            </div>
                            <div class="header__top__right__cart">
                                @auth
                                <a href="{{route('cart.show')}}"><img src="{{asset('template/img/icon/cart.png')}}" alt=""> <span id="quantityOfProduct">{{ session('cartLength') }}</span></a>
                                <div class="cart__price">Cart: <span id="totalCartPrice">$ {{ session('total') }}</span></div>
                                @endauth

                                @guest
                                    <a href="{{route('cart.show')}}"><img src="{{asset('template/img/icon/cart.png')}}" alt=""> <span id="quantityOfProduct"></span></a>
                                    <div class="cart__price">Cart: <span id="totalCartPrice"></span></div>
                                    <script>
                                        var cart = JSON.parse(localStorage.getItem('guestCart'));
                                        var cartLength = cart.listProducts.length;
                                        var total = JSON.parse(localStorage.getItem('total'));
                                        document.getElementById('quantityOfProduct').innerHTML = cartLength;
                                        document.getElementById('totalCartPrice').innerHTML = total;
                                    </script>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{route('client-views.home')}}">Home</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="http://127.0.0.1:8000/shop">Shop</a></li>
                        <li><a href="">Pages</a>
                            {{-- <ul class="dropdown">
                                <li><a href="">Shop Details</a></li>
                                <li><a hre="">Shoping Cart</a></li>
                                <li><a href="">Register</a></li>
                                <li><a href="">Wisslist</a></li>
                                <li><a href="">Class</a></li>
                                <li><a href="">Blog Details</a></li>
                            </ul> --}}
                        </li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>