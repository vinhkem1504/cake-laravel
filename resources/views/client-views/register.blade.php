@extends('layouts.client')

@section('title-bar')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Register</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="./index.html">Home</a>
                    <span>Register</span>
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
            <form id="register_form" method="post" action="">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have an account? <a href="login.html">Click
                        <b>here</b></a> to sgin in your account</h6>
                        <h6 class="checkout__title">Information</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text" id="first_name" onkeyup="processChangeFirstName()" oninput="checkEmptyInput(isRegister)">
                                    <p id="result_firstName" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" id="last_name" onkeyup="processChangeLastName()" oninput="checkEmptyInput(isRegister)">
                                    <p id="result_lastName" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" id="email" onkeyup="processChangeEmail()" oninput="checkEmptyInput(isRegister)">
                                    <p id="result_email" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Account Password<span>*</span></p>
                            <input type="password" id="password" onkeyup="processChangePassword()" oninput="checkEmptyInput(isRegister)">
                            <p id="result_password" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                        </div>
                    
                    </div>
                </div>
                <button type="submit" class="site-btn btn_register" id="btn_register" disabled="true">REGISTER</button>
            </form>
        </div>
    </div>
</section>
@endsection