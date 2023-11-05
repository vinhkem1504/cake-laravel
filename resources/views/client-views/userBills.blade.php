@extends('layouts.userInfo')
@section('title-bar')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Buy History</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('client-views.user')}}">User</a>
                    <span>Buy History</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{ route('update-user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">List Bills</h6>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" style="width: 10%">ID</th>
                                <th scope="col" style="width: 50%">ADDRESS</th>
                                <th scope="col" style="width: 20%">DATE</th>
                                <th scope="col" style="width: 20%">STATUS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Larry the BirdLarry the BirdLarry the BirdLarry the Bird</td>
                                <td>@twitter</td>
                                <td>@mdo</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h6 class="order__title">Your order</h6>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products" style="overflow: auto; height: 350px;">
                                <li><samp>01.</samp> Vanilla salted caramel <span>$ 300.0</span></li>
                                <li><samp>02.</samp> German chocolate <span>$ 170.0</span></li>
                                <li><samp>03.</samp> Sweet autumn <span>$ 170.0</span></li>
                                <li><samp>04.</samp> Cluten free mini dozen <span>$ 110.0</span></li>
                                <li><samp>01.</samp> Vanilla salted caramel <span>$ 300.0</span></li>
                                <li><samp>02.</samp> German chocolate <span>$ 170.0</span></li>
                                <li><samp>03.</samp> Sweet autumn <span>$ 170.0</span></li>
                                <li><samp>04.</samp> Cluten free mini dozen <span>$ 110.0</span></li>
                                <li><samp>01.</samp> Vanilla salted caramel <span>$ 300.0</span></li>
                                <li><samp>02.</samp> German chocolate <span>$ 170.0</span></li>
                                <li><samp>03.</samp> Sweet autumn <span>$ 170.0</span></li>
                                <li><samp>04.</samp> Cluten free mini dozen <span>$ 110.0</span></li>
                                <li><samp>01.</samp> Vanilla salted caramel <span>$ 300.0</span></li>
                                <li><samp>02.</samp> German chocolate <span>$ 170.0</span></li>
                                <li><samp>03.</samp> Sweet autumn <span>$ 170.0</span></li>
                                <li><samp>04.</samp> Cluten free mini dozen <span>$ 110.0</span></li>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Total <span>$750.99</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection