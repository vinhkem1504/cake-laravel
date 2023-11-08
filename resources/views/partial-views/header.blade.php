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
                                    @if (!auth()->user()->avatar_image)
                                        <a href="{{route('client-views.user')}}"><img src="{{asset('template/img/icon/user.png')}}" alt=""></a>
                                    @else
                                        <a href="{{route('client-views.user')}}"><img  id="user-avatar" src="{{ auth()->user()->avatar_image }}" alt=""></a>
                                    @endif
                                    <a href="#" id="notification-button"><img src="{{ asset('template/img/icon/bell.png') }}" alt="">
                                        <span class="badge badge-warning navbar-badge" id="number-noti">{{ session('notifications')->count() }}</span>
                                    </a>
                                    <div id="notification-menu">
                                        {{-- <span class="dropdown-item dropdown-header" id="number-noti-text">{{ session('notifications')->count() }} Notifications</span> --}}
                                        @foreach (session('notifications') as $item)
                                            <a href="#" class="dropdown-item">
                                                {{ $item->content }}
                                                @php
                                                    $time = '';
                                                    $timeCurrent = time(); // Lấy thời gian hiện tại dưới dạng timestamp
                                                    $itemCreatedAt = strtotime($item->created_at); // Chuyển đổi thời gian tạo của $item thành timestamp
                                                    $timeDiff = $timeCurrent - $itemCreatedAt;

                                                    if ($timeDiff < 60) {
                                                        $time = $timeDiff . ' seconds ago';
                                                    } elseif ($timeDiff < 3600) {
                                                        $minutes = floor($timeDiff / 60);
                                                        $time = $minutes . ' minutes ago';
                                                    } elseif ($timeDiff < 86400) {
                                                        $hours = floor($timeDiff / 3600);
                                                        $time = $hours . ' hours ago';
                                                    } else {
                                                        $days = floor($timeDiff / 86400);
                                                        $time = $days . ' days ago';
                                                    }
                                                @endphp
                                                <span class="float-right text-muted text-sm">{{ $time }}</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                                        @endforeach
                                    </div>
                                    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
                                    <script>
                                        // Pusher.logToConsole = true
                                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                                            cluster: 'ap1',
                                            encrypted: true,
                                            authEndpoint: 'pusher/auth',
                                            auth: {
                                                headers: {
                                                    'X-CSRF-Token': csrfToken
                                                }
                                            }
                                        });

                                        var userId = {{ auth()->user()->user_id }}; // Thay thế bằng `userId` thực tế của người dùng

                                        // Đăng ký kênh riêng tư dựa trên userId
                                        var privateChannel = pusher.subscribe('private-channel-user-' + userId);

                                        privateChannel.bind('send-noti', function(data) {
                                            var notiMenu = document.getElementById('notification-menu');
                                            var existMenu = notiMenu.innerHTML;
                                            var numberNoti = document.getElementById('number-noti');
                                            console.log('text', typeof +numberNoti.innerHTML)
                                            var timeCreated = data.created_at;

                                            var noti = `
                                            <a href="#" class="dropdown-item">
                                                ${data.content}
                                                <span class="float-right text-muted text-sm">a few seconds</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            `
                                            notiMenu.innerHTML = (noti + existMenu);
                                            // numberNoti += 1;
                                            document.getElementById('number-noti').innerHTML = (+numberNoti.innerHTML+ 1);
                                            document.getElementById('number-noti-text').innerHTML = (+numberNoti.innerHTML + 1 + ' Notifications');
                                            console.log('Nhận thông điệp từ kênh riêng tư:', data);
                                        });
                                        // console.log('hehre')
                                    </script>
                                {{-- <a href="{{route('client-views.user')}}"><p>{{auth()->user()->name}}</p></a> --}}
                                @endauth

                                @guest
                                <a href="#"><img src="{{asset('template/img/icon/heart.png')}}" alt=""></a>
                                @endguest
                                
                            </div>
                            <div class="header__top__right__cart">
                                @auth
                                <a href="{{route('cart.show')}}"><img src="{{asset('template/img/icon/cart.png')}}" alt=""> <span id="quantityOfProduct">{{ session('cartLength') }}</span></a>
                                <div class="cart__price">Cart: $ <span id="totalCartPrice">{{ session('total') }}</span></div>
                                @endauth

                                @guest
                                    <a href="{{route('cart.show')}}"><img src="{{asset('template/img/icon/cart.png')}}" alt=""> <span id="quantityOfProduct"></span></a>
                                    <div class="cart__price">Cart: $ <span id="totalCartPrice"></span></div>
                                    <script>
                                        var cart = JSON.parse(localStorage.getItem('guestCart'));
                                        var cartLength = cart.listProducts.length;
                                        var total = JSON.parse(localStorage.getItem('total'));
                                        document.getElementById('quantityOfProduct').innerHTML = cartLength;
                                        document.getElementById('totalCartPrice').innerHTML = +total;
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
                        <li><a href="./about.html">About</a></li>
                        <li><a href="./shop.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./register.html">Register</a></li>
                                <li><a href="./wisslist.html">Wisslist</a></li>
                                <li><a href="./Class.html">Class</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
