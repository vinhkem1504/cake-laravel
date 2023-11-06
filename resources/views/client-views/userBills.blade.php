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
                                @foreach ($bill as $item)
                                <tr>
                                    <th scope="row" onclick="showBillDetails({{ $item->bill_id }})">{{ $item->bill_id }}</th>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->date }}</td>
                                    @if ($item->status == 0)
                                        <td class="alert alert-warning" onclick="handleCancel({{ $item->bill_id }})" id="status-bill-{{ $item->bill_id }}">Pending</td>
                                        <a href="#" class="heart__btn"><span class="icon_heart_alt"></span></a>
                                        <!-- Alert add cart -->
                                        <div class="modal fade" id="alertDialog-{{ $item->bill_id }}" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="height: 70px; padding: 10px 30px; align-items: center !important">
                                                        <h4 class="modal-title" id="modalTitle">Thông báo</h4>
                                                        <button type="button" class="close" data-dismiss="modal" id="closeButton">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Xác nhận hủy <i><b>{{ $item->bill_id }}</b></i> ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeDialogButton-{{ $item->bill_id }}">Cancel</button>
                                                        <button type="button" class="btn btn-success" id="confirmDialogButton-{{ $item->bill_id }}">Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item->status == 1)
                                        <td class="alert alert-success" id="status-bill-{{ $item->bill_id }}">Deliverd</td>
                                    @else
                                        <td class="alert alert-danger" id="status-bill-{{ $item->bill_id }}">Cancel</td>
                                    @endif
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h6 class="order__title">Your order: <i id="current-bill-id">ID {{ $bill[0]->bill_id }}</i></h6>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul id="bill-details-products" class="checkout__total__products" style="overflow: auto; height: 250px;">
                                @php
                                    $total = 0;
                                @endphp
                                @if ($details)
                                    @foreach ($details as $item)
                                        <li><samp>{{ $item->quanlity }}</samp> {{ $item->productname . ' - ' . $item->flavourValue . ' - ' . $item->sizeValue }} <span>$ {{ $item->price * $item->quanlity }}</span></li>
                                        @php
                                            $total += $item->price * $item->quanlity;
                                        @endphp
                                    @endforeach
                                @endif
                            </ul>
                            <ul class="checkout__total__all" >
                                <li>Total <span id="bill-total">${{ $total }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
