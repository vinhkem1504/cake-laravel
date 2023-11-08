@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User List</h1>
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
                                <h3 class="card-title">User search</h3>
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
                                            <label for="email">Name</label>
                                            <input type="email" 
                                                class="form-control" name="email" id="email"
                                                value="{{ Request::get('email')}}"
                                                placeholder="Enter Mail"
                                               />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px" 
                                            href="/admin/user">Reset</a>
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
                                <h3 class="card-title">User List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number of Bills</th>
                                            <th>Total Spend</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $value)
                                            <tr>
                                                <td> {{$value->user_id}}</td>
                                                <td> {{$value->name}}</td>
                                                <td> {{$value->email}}</td>
                                                <td> {{$value->total_bills}}</td>
                                                <td> {{$value->total_bill_amount}} $</td>
                                                <td>
                                                    <a href="/admin/bill/index?user_id={{$value->user_id}}"
                                                        class="btn btn-primary">Bill List</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    {!! $users->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
