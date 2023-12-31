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
                        <input type="hidden" name="product_id" value="{{ $product[0]->product_id }}">
                        <h4>{{ $product[0]->productname }}</h4>
                        <h5>${{ $product[0]->price_default }}</h5>
                        <p>{{ $product[0]->info }}</p>
                        <ul>
                            <li>Category: <span>{{ $product[0]->category_name }}</span></li>
                            <li>Rating: <span id="sum_star"></span> <img src="/template/img/shop/details/detail_options/star.png"/> </li>
                        </ul>
                        <div class="product__details__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="1">
                                </div>
                            </div>
                            <a id="cart" onclick="handleAddToCart()" class="primary-btn btn_register" disabled >Add to cart</a>
                            <button id="openAlertNotication" hidden class="btn btn-primary" data-toggle="modal" data-target="#alertDialog">Mở Hộp Thoại Cảnh Báo</button>
                            <a href="#" class="heart__btn"><span class="icon_heart_alt"></span></a>
                            <!-- Alert add cart -->
                            <div class="modal fade" id="alertDialog" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="height: 70px; padding: 10px 30px; align-items: center !important">
                                            <h4 class="modal-title" id="modalTitle">Thông báo</h4>
                                            <button type="button" class="close" data-dismiss="modal" id="closeButton">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Sản phẩm <i><b>{{ $product[0]->productname }}</b></i> đã được thêm vào giỏ hàng</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal" id="closeDialogButton">Tiếp tục mua</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Alert add cart -->
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
                                                    <input type="radio" name="optional_size" id="{{ $item->value }}" value="{{ $item->size_id }}">
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
                                                    <input type="radio" name="optional_flavour" id="{{ $item->value }}" value="{{ $item->flavour_id }}">
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
            {{-- comment - raitng --}}
            <div class="product__details__tab">
                <div class="col-lg-12">
                    <ul class="nav cmt">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab">Rate(<span id="count_cmt">{{$cmt}}</span>)</a>
                        </li>
                        {{-- <li style="padding-top: 10px; padding-left: 20px"><a id="reload"><img src="/template/img/shop/details/detail_options/reload.png" /></a></li> --}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-3" role="tabpanel">
                            <div class="row d-flex wrapper-comments">
                                <ul class="comment-list" style="width: 100%; height: 450px; overflow:auto;">         
                                </ul>     
                            </div>
                        </div>
                    </div>
                    
                    <div class="cmt__newslatter">
                        <form action="{{route('rating.create')}}">
                            <textarea  rows="5" id='cmt' type="text" placeholder="Typing here"></textarea>
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                            <button type="button" id="send_cmt">Send</button>
                        </form>
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
                                        <a onclick="handleAddToCart()">Add to cart</a>
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

