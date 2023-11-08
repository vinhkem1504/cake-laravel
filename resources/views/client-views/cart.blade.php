@extends('layouts.productInfo')
@section('title-bar')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('client-views.home') }}">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
@endsection
@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="displayTable">
                                @if ($cart)
                                    @foreach ($cart as $product)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img class="check-out-product-image" src="{{ $product->image }}" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $product->productname }}</h6>
                                                    <h5 id="product-details-id-{{ $product->product_details_id }}-price">{{ $product->price }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty" id="{{ $product->product_details_id }}">
                                                        <input type="text" value="{{ $product->quanlity }}" id="product-details-id-{{ $product->product_details_id }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price" id="product-details-id-{{ $product->product_details_id }}-total-price">
                                               $ {{ $product->price * $product->quanlity }}
                                            </td>
                                            <td class="cart__close"><span class="icon_close" onclick="handleDeleteOneTypeProduct({{ $product->product_details_id }})"></span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <script>
                                        function showCartFromLocal(){
                                            var cart = JSON.parse(localStorage.getItem('guestCart'));
                                            var quantity = cart.listProducts.length;
                                            if(cart.listProducts){
                                                var str = '';
                                                var total = 0;
                                                cart.listProducts.forEach(function(item){
                                                    str += 
                                                    `
                                                    <tr>
                                                        <td class="product__cart__item">
                                                            <div class="product__cart__item__pic">
                                                                <img class="check-out-product-image" src="${item.image}" alt="">
                                                            </div>
                                                            <div class="product__cart__item__text">
                                                                <h6>${item.productname}</h6>
                                                                <h5 id="product-details-id-${item.product_details_id}-price">${item.price}</h5>
                                                            </div>
                                                        </td>
                                                        <td class="quantity__item">
                                                            <div class="quantity">
                                                                <div class="pro-qty" id="${item.product_details_id}">
                                                                    <input type="text" value="${item.quanlity}" id="product-details-id-${item.product_details_id}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cart__price" id="product-details-id-${item.product_details_id}-total-price">
                                                            ${+item.price * +item.quanlity}
                                                        </td>
                                                        <td class="cart__close"><span class="icon_close" onclick="handleDeleteOneTypeProduct(${item.product_details_id})"></span></td>
                                                    </tr>
                                                    `
                                                    total += +item.quanlity * +item.price;
                                                    // console.log('total', total)
                                                })
                                                var elem = document.getElementById('total-cart-price');
                                                document.getElementById('displayTable').innerHTML = str;
                                                localStorage.setItem('total', JSON.stringify(total));
                                                document.getElementById('quantityOfProduct').innerHTML = quantity;
                                                document.getElementById('totalCartPrice').innerHTML = + total;;
                                            }
                                        }
                                        showCartFromLocal();
                                    </script>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('client-views.home') }}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            {{-- <li>Subtotal <span id="total-cart-price" class="total-cart-price">{{ $total }}</span></li> --}}
                            <li>Total <span id="total-cart-price">
                                @if ($total)
                                    $ {{ $total }}
                                @else
                                    <script>
                                        var total = JSON.parse(localStorage.getItem('total'));
                                        document.getElementById('total-cart-price').innerHTML = + total;
                                    </script>
                                @endif
                                
                            </span></li>
                            
                        </ul>
                        <a href="{{ route('show.checkoutCart') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

