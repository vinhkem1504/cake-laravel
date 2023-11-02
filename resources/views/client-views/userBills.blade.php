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
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h5 style="display: flex; justify-content: space-between; align-items: flex-end">Bill 1<span class="badge badge-pill badge-danger">Da cho</span></h5>
                            </li>
                            <li class="list-group-item">
                                <h5 style="display: flex; justify-content: space-between; align-items: flex-end">Bill 1<span class="badge badge-pill badge-success">Da xac nhan</span></h5>
                            </li>
                            <li class="list-group-item" >
                                <h5 style="display: flex; justify-content: space-between; align-items: flex-end">Bill 1<span class="badge badge-pill badge-success">Da xac nhan</span></h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection