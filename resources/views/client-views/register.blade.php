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
                    <a href="{{route('client-views.home')}}">Home</a>
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
            <form id="register_form" action="{{route('register.perform')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <h6 class="status_register" style="display: none"><span class="icon_tag_alt"></span> Have an account? <a href="{{route('login.show')}}">Click
                                <b>here</b></a> to sgin in your account</h6>
                        <h6 class="checkout__title">Information</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Your Name<span>*</span></p>
                                    <input name="name" type="text" id="name" value="{{ old('name') }}" onkeyup="processChangeFirstName()" oninput="checkEmptyInput(isRegister)">
                                    <p id="result_firstName" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input name="email" type="text" id="email" value="{{ old('email') }}" onkeyup="processChangeEmail()" oninput="checkEmptyInput(isRegister)">
                                    <p id="result_email" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Account Password<span>*</span></p>
                            <input name="password" type="password" id="password" value="{{ old('password') }}" onkeyup="processChangePassword()" oninput="checkEmptyInput(isRegister)">
                            <p id="result_password" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                        </div>
                        <div class="checkout__input">
                            <p>Confirm Password<span>*</span></p>
                            <input name="confirm_password" type="password" id="confirm_password" value="{{ old('confirm_password') }}" onkeyup="processConfirmPassword()" oninput="checkEmptyInput(isRegister)">
                            <p id="result_confirm_password" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
                        </div>
                    </div>
                </div>
                <button type="button" class="site-btn btn_register" id="btn_register" disabled="true">REGISTER</button>
            </form>
        </div>
    </div>
</section>
@endsection