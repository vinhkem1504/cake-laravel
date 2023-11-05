@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Import Bill List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/import_bill/add" class="btn btn-primary">Add New Import Bill</a>
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
                                <h3 class="card-title">Import Bill search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="date">Date</label>
                                            <input type="date" 
                                                class="form-control" name="date" id="date"
                                                value="{{ Request::get('date')}}"
                                                placeholder="Enter Date"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="supplier_id">Supplier</label>
                                            <select class="form-control" name="supplier_id">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $value)
                                                    <option value="{{ $value->supplier_id }}" {{ (Request::get('supplier_id') == $value->supplier_id) ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px" 
                                            href="/admin/import_bill">Reset</a>
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
                                <h3 class="card-title">Import Bill List (Total: {{ $import_bills->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Total Price</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($import_bills as $value)
                                            <tr>
                                                <td>{{  $value->import_bill_id  }}</td>
                                                <td>{{  date('d-m-Y', strtotime($value->date)) }}</td>
                                                <td> {{  $value->supplier_name  }}  </td>
                                                <td> {{  $value->total_price  }} $</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <a href="/admin/import_bill/edit/{{ $value->import_bill_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/import_bill/delete/{{ $value->import_bill_id }}"
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
                                    {!! $import_bills->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
