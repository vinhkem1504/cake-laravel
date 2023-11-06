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
                    <a href="{{route('client-views.bills')}}">Buy History</a>
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
            <form action="{{ route('update-user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Information Details</h6>
                        {{-- @if ($message)
                            <h6 class="checkout__title success">{{$message}}</h6>
                        @endif --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="">
                                    <p>Avatar<span>*</span></p>
                                    <div class="image-upload">
                                        <label for="file-input">
                                            @if(!isset(auth()->user()->avatar_image))
                                                <img id="preview-image" class="user-image" src="template/img/user.png" />
                                            @else
                                                <img id="preview-image" class="user-image" src="{{ auth()->user()->avatar_image }}" />
                                            @endif
                                        </label>
                                        <input id="file-input" name="userImage" type="file" onchange="handleImageChange(this)" accept="image/*"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Your Name<span>*</span></p>
<<<<<<< HEAD
                                    <input type="text" value="{{auth()->user()->name}}" id="name" name="userName" onkeyup="processChangeFirstName()" oninput="checkUser(isUser)">
                                    <p id="result_firstName" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
=======
                                    <input type="text" value="{{auth()->user()->name}}" id="name" name="userName" onkeyup="processChangeFirstName(isUser)" oninput="checkEmptyInput(isUser)">
                                    <p id="result_firstName" style="display: block; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
>>>>>>> 1161049f5d43ea4046baef2b5a56beee070b5294

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
<<<<<<< HEAD
                                    <input type="text" value="{{auth()->user()->email}}" id="email" name="email" onkeyup="processChangeEmail()" oninput="checkUser(isUser)">
=======
                                    <input type="text" value="{{auth()->user()->email}}" id="email" name="email" disabled>
>>>>>>> 1161049f5d43ea4046baef2b5a56beee070b5294
                                    <p id="result_email" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>

                                </div>
                            </div>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="diff-acc">
                                Change password?
                                <input type="checkbox" id="diff-acc" onchange="showInputChangePassword()" name="check">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input hidden-input" id="password">
                            <p>Account Password<span>*</span></p>
                            <input type="password" name="password" value="">
                        </div>
                        <div class="checkout__input hidden-input" id="new_password">
                            <p>New Password<span>*</span></p>
                            <input type="password" name="newPassword" id="password" value="{{ old('password') }}" onkeyup="processConfirmPassword()" oninput="checkUser(isUser)">
                            <p id="result_password" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>
 
                        </div>
                        <div class="checkout__input hidden-input" id="confirm_password">
                            <p>Confirm Password<span>*</span></p>
                            <input type="password" name="confirmPassword" id="confirm_password" value="{{ old('confirm_password') }}"onkeyup="handleOnChangeForgetPassword(isChange)" oninput="checkUser(isUser)">
                            <p id="result_confirm_password" style="display: none; color: red; font-size: small; font-style: italic; margin-top: -20px;"></p>

                        </div>
                    </div>
                </div>
                <button type="submit" class="site-btn" id="btn_update" disabled="true">UPDATE</button>
            </form>
        </div>
    </div>
</section>
@endsection