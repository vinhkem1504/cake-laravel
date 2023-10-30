@extends('layouts.client')

@section('map')
{{-- @include('partial-views.map') --}}
@endsection

@section('content')
<!-- Hero Section Begin -->
<section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="/template/img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Making your life sweeter one bite at a time!</h2>
                                <a href="#" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Making your life sweeter one bite at a time!</h2>
                                <a href="#" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Cakes and bakes from the house of Queens!</h2>
                        </div>
                        <p>The "Cake Shop" is a Jordanian Brand that started as a small family business. The owners are
                        Dr. Iyad Sultan and Dr. Sereen Sharabati, supported by a staff of 80 employees.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="about__bar">
                        <div class="about__bar__item">
                            <p>Cake design</p>
                            <div id="bar1" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="95"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Class</p>
                            <div id="bar2" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="80"></span>
                            </div>
                        </div>
                        <div class="about__bar__item">
                            <p>Cake Recipes</p>
                            <div id="bar3" class="barfiller">
                                <div class="tipWrap"><span class="tip"></span></div>
                                <span class="fill" data-percentage="90"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Categories Section Begin -->
    @include('client-views.category')
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    @include('client-views.productList')
    <!-- Product Section End -->


<div class="bg-light p-5 rounded">
    @include('partial-views.messages')
    @auth
    <h1>Dashboard</h1>
    {{auth()->user()->name}}
    <p class="lead">Only authenticated users can access this section.</p>
    <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
    @endauth

    @guest
    <h1>Homepage</h1>
    <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
    @endguest
</div>
@endsection