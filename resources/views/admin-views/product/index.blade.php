@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/product/add" class="btn btn-primary">Add New Product</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="productname">Name</label>
                                            <input type="text" class="form-control" name="productname" id="productname"
                                                value="{{ Request::get('productname') }}" placeholder="Enter Name" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" name="supplier_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $value)
                                                    <option value="{{ $value->category_id }}"
                                                        {{ Request::get('category_id') == $value->category_id ? 'selected' : '' }}>
                                                        {{ $value->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px"
                                                href="/admin/product">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product List (Total: {{ $products->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Price Default</th>
                                            {{-- <th>Created At</th>
                                            <th>Updated At</th> --}}
                                            <th style="width: 200px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $value)
                                            <tr>
                                                <td>{{ $value->product_id }}</td>
                                                <td>{{ $value->productname }}</td>
                                                <td><img src="{{ $value->product_avt_iamge }}" alt="img"
                                                        class="img-fluid rounded-circle" style="width: 60px; height:60px">
                                                </td>
                                                <td>{{ $value->category_name }} </td>
                                                <td>{{ $value->price_default }} $</td>
                                                {{-- <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td> --}}
                                                <td>
                                                    <a href="/admin/product/edit/{{ $value->product_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/product/delete/{{ $value->product_id }}"
                                                        class="btn btn-danger">Delete</a>
                                                    <a href="/admin/product_details/index/{{ $value->product_id }}"
                                                        class="btn btn-secondary mt-2">Product Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    {!! $products->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
