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
                        <a href="./index.html">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
@endsection
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('create.bill')}}" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            <b>here</b></a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" disabled value="{{ auth()->user()->name }}" id="name" onkeyup="processChangeFirstName()" oninput="checkBill(isRegister)">
                                        <p id="result_firstName" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" id="address" placeholder="Street Address" class="checkout__input__add" onkeyup="processChangeAddress()" oninput="checkBill(isRegister)">
                                <p id="result_address" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phoneNumber" id = 'phone' onkeyup="processChangePhone()" oninput="checkBill(isRegister)">
                                        <p id="result_phone" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" id="email" onkeyup="processChangeEmail()" oninput="checkBill(isRegister)">
                                        <p id="result_email" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h6 class="order__title">Your order</h6>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products" style="overflow: auto; height: 350px;">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($products as $item)
                                        <li><samp>{{ $item->product_details_id }}</samp> {{ $item->productname . ' - ' . $item->flavourValue . ' - ' . $item->sizeValue }} <span>{{ $item->price * $item->quanlity }}</span></li>
                                        @php
                                            $total += $item->price * $item->quanlity;
                                        @endphp
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span>{{ $total }}</span></li>
                                </ul>
                                <button type="submit" class="site-btn btn_register" id="btn_register" disabled="true">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection