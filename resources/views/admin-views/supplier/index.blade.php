@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Supplier List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/supplier/add" class="btn btn-primary">Add New Supplier</a>
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
                                <h3 class="card-title">Supplier search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" 
                                                class="form-control" name="name" id="name"
                                                value="{{ Request::get('name')}}"
                                                placeholder="Enter Name"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="unit">Phone</label>
                                            <input type="tel" 
                                                class="form-control" name="phone" id="phone"
                                                value="{{ Request::get('phone')}}"
                                                placeholder="Enter phone"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="address">Address</label>
                                            <input type="text" 
                                                class="form-control" name="address" id="address"
                                                value="{{ Request::get('address')}}"
                                                placeholder="Enter address"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px" 
                                            href="/admin/supplier">Reset</a>
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
                                <h3 class="card-title">Supplier List (Total: {{ $suppliers->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $value)
                                            <tr>
                                                <td>{{ $value->supplier_id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <a href="/admin/supplier/edit/{{ $value->supplier_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/supplier/delete/{{ $value->supplier_id }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    {!! $suppliers->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
