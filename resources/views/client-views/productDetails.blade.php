@extends('layouts.productInfo')

@section('title-bar')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="{{ route('client-views.home') }}">Home</a>
                        <a href="">Shop</a>
                        <span>{{ $product[0]->productname }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="product__details__big__img">
                            <img class="big_img" src="{{ $product[0]->product_avt_iamge }}" alt="">
                        </div>
                        <div class="product__details__thumb">
                            @foreach ($product_details as $item)
                                <div class="pt__item active">
                                    <img data-imgbigurl="{{ $item->image }}" src="{{ $item->image }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <div class="product__label" id="{{ $product[0]->product_id}}">{{ $product[0]->category_name }}</div>
                        <h4>{{ $product[0]->productname }}</h4>
                        <h5>${{ $product[0]->price_default }}</h5>
                        <p>{{ $product[0]->info }}</p>
                        <ul>
                            <li>Category: <span>{{ $product[0]->category_name }}</span></li>
                        </ul>
                        <div class="product__details__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="2">
                                </div>
                            </div>
                            <a href="#" class="primary-btn" disabled>Add to cart</a>
                            <a href="#" class="heart__btn"><span class="icon_heart_alt"></span></a>
                           
                        </div>
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Size</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Flavour</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="row tab-pane active" id="tabs-1" role="tabpanel">
                                    @foreach ($size as $item)
                                        <div class="col-lg-6">
                                            <div class="checkout__input__checkbox">
                                                <label for="{{ $item->value }}">
                                                    {{ $item->value }}
                                                    <input type="radio" name="optional_size" id="{{ $item->value }}" value="{{ $item->value }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    @foreach ($flavour as $item)
                                        <div class="col-lg-6">
                                            <div class="checkout__input__checkbox">
                                                <label for="{{ $item->value }}">
                                                    {{ $item->value }}
                                                    <input type="radio" name="optional_flavour" id="{{ $item->value }}" value="{{ $item->value }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="error_message" style="display: none">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Products Section Begin -->
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="related__products__slider owl-carousel">
                    @foreach ($products_related as $item)
                        <div class="col-lg-3">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $item->product_avt_iamge }}">
                                    <div class="product__label">
                                        <span>{{ $item->category_name }}</span>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{ $item->productname }}</a></h6>
                                    <div class="product__item__price">${{ $item->price_default }}</div>
                                    <div class="cart_add">
                                        <a href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Related Products Section End -->
@endsection
