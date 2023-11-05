@extends('layouts.admin')
@section('content')
    <div class="content-wrapper" style="min-height: 664px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bill: #{{ $bill_id }}</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="/admin/bill" class="btn btn-primary">Back To List</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        @include('_message')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header pt-3">
                                <div class="row invoice-info">
                                    <div class="col-md-6 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong>{{ $billAddress->user_name }}</strong><br>
                                            Address: {{ $billAddress->user_address }}<br>
                                            Phone: {{ $billAddress->user_phone }}<br>
                                            Email: {{ $billAddress->user_email }}
                                        </address>
                                    </div>
                                    <div class="col-md-6 invoice-col">
                                        <b>Bill #{{ $bill_id }}</b><br><br>
                                        <b>Total:</b> ${{ $billProducts->sum('product_total_price') }}<br>
                                        <b>Status:</b>
                                        @if ($billAddress->status == 0)
                                            <span class="text-warning">Pending</span>
                                        @elseif ($billAddress->status == 1)
                                            <span class="text-success">Delivered</span>
                                        @else
                                            <span class="text-danger">Cancel</span>
                                        @endif
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th width="100">Price</th>
                                            <th width="100">Qty</th>
                                            <th width="100">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($billProducts as $product)
                                            <tr>
                                                <td>
                                                    {{ $product->product_name }},
                                                    Size: {{ $product->product_size }},
                                                    Flavour: {{ $product->product_flavour }}
                                                </td>
                                                <td>${{ $product->product_price }}</td>
                                                <td>{{ $product->product_quantity }}</td>
                                                <td>${{ $product->product_total_price }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="3" class="text-right">Subtotal:</th>
                                            <td>${{ $billProducts->sum('product_total_price') }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Grand Total:</th>
                                            <td>${{ $billProducts->sum('product_total_price') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Bill Status</h2>
                                <form method="POST">
                                    {{ csrf_field() }}
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            @if ($billAddress->status == 0)
                                                <option value="1">Delivered</option>
                                                <option value="2">Cancel</option>
                                            @elseif ($billAddress->status == 1)
                                                <option value="1">Delivered</option>
                                            @else
                                                <option value="2">Cancel</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        @if ($billAddress->status == 0)
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        @endif
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
