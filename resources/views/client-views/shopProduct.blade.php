@extends('layouts.shop')

@section('title-bar')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
@endsection

@section('content')
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search">
                            <form action="#">
                                <select id="title_select">
                                    <option>Categories</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" placeholder="Search" id="search_shop">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select>
                                <option value="">Default sorting</option>
                                <option value="">A to Z</option>
                                <option value="">1 - 8</option>
                                <option value="">Name</option>
                            </select>
                            <a href="#"><i class="fa fa-list"></i></a>
                            <a href="#"><i class="fa fa-reorder"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row products_list">
                @foreach ($products as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $item->product_avt_iamge }}">
                                <div class="product__label">
                                    <span>{{ $item->category_name }}</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="{{ route('client-views.productDetails', ['product_id' => $item->product_id]) }}">{{ $item->productname }}</a>
                                </h6>
                                <div class="product__item__price">${{ $item->price_default }}</div>
                                <div class="cart_add">
                                    <a
                                        href="{{ route('client-views.productDetails', ['product_id' => $item->product_id]) }}">Add
                                        to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="shop__pagination">
                <a id="previous_page_shop"><span class="arrow_carrot-left"></span></a>
                <div class="page_shop_pagination"></div>
                <a id="next_page_shop"><span class="arrow_carrot-right"></span></a>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
