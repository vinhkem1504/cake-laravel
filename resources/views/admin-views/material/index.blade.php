@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Material List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/material/add" class="btn btn-primary">Add New Material</a>
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
                                <h3 class="card-title">Material search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="material_name">Name</label>
                                            <input type="text" 
                                                class="form-control" name="material_name" id="material_name"
                                                value="{{ Request::get('material_name')}}"
                                                placeholder="Enter Name"
                                               />
                                        </div>
                                        {{-- <div class="form-group col-md-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" 
                                                class="form-control" name="quantity" id="quantity"
                                                value="{{ Request::get('quantity')}}"
                                                placeholder="Enter quantity"
                                               />
                                        </div> --}}
                                        <div class="form-group col-md-3">
                                            <label for="unit">Unit</label>
                                            <input type="text" 
                                                class="form-control" name="unit" id="unit"
                                                value="{{ Request::get('unit')}}"
                                                placeholder="Enter unit"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px" 
                                            href="/admin/material">Reset</a>
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
                                <h3 class="card-title">Material List (Total: {{ $materials->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materials as $value)
                                            <tr>
                                                <td>{{ $value->material_id }}</td>
                                                <td>{{ $value->material_name }}</td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>{{ $value->unit }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <a href="/admin/material/edit/{{ $value->material_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/material/delete/{{ $value->material_id }}"
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
                                    {!! $materials->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
