@extends('layouts.userInfo')

@section('title-bar')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>User Information</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="{{route('client-views.home')}}">Home</a>
                    <span>User Information</span>
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
            <form action="#">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Information Details</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Your Name<span>*</span></p>
                                    <input type="text" value="{{auth()->user()->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" value="{{auth()->user()->email}}" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Account Password<span>*</span></p>
                            <input type="password" value="">
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Change password?
                                <input type="checkbox" id="diff-acc" onchange="showInputChangePassword()">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input hidden-input" id="new_password">
                            <p>New Password<span>*</span></p>
                            <input type="text" >
                        </div>
                        <div class="checkout__input hidden-input" id="confirm_password">
                            <p>Confirm Password<span>*</span></p>
                            <input type="text" >
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection