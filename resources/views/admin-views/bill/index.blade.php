@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Bill List</h1>
                    </div><!-- /.col -->
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
                                <h3 class="card-title">Bill search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="bill_id">Bill Id</label>
                                            <input type="text" 
                                                class="form-control" name="bill_id" id="bill_id"
                                                value="{{ Request::get('bill_id')}}"
                                                placeholder="Enter Bill Id"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="user_id">User Id</label>
                                            <input type="text" 
                                                class="form-control" name="user_id" id="user_id"
                                                value="{{ Request::get('user_id')}}"
                                                placeholder="Enter User Id"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="5" selected>All</option>
                                                <option value="0" @if (Request::get('status') == 0 && Request::get('status') !== null) selected @endif>Pending</option>
                                                <option value="1" @if (Request::get('status') == 1) selected @endif>Delivered</option>
                                                <option value="2" @if (Request::get('status') == 2) selected @endif>Canceled</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px" 
                                            href="/admin/bill">Reset</a>
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
                                <h3 class="card-title">Bill List (Total: {{ $bills->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Date</th>
                                            <th>Phone</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bills as $value)
                                            <tr>
                                                <td><a href="/admin/bill/{{$value->bill_id}}">{{  $value->bill_id  }}</a></td>
                                                <td>{{  $value->user_id  }}</td>
                                                <td>{{  date('d-m-Y', strtotime($value->date)) }}</td>
                                                <td>{{  $value->phone_number }}</td>
                                                <td>{{  $value->total_price  }} $</td>
                                                <td>
                                                    @if ($value->status == 0)
                                                        <span class="badge badge-pill badge-primary">Pending</span>
                                                    @elseif ($value->status == 1)
                                                        <span class="badge badge-pill badge-success">Delivered</span>
                                                    @elseif ($value->status == 2)
                                                        <span class="badge badge-pill badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    {!! $bills->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
