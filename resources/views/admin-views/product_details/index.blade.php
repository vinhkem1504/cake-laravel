@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product Detail List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/product_details/add/{{$product_id}}" class="btn btn-primary">Add New Detail</a>
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
                                <h3 class="card-title">Detail search</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="size_id">Size</label>
                                            <select class="form-control" name="size_id">
                                                <option value="">Select Size</option>
                                                @foreach ($sizes as $value)
                                                    <option value="{{ $value->size_id }}"
                                                        {{ Request::get('size_id') == $value->size_id ? 'selected' : '' }}>
                                                        {{ $value->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="flavour_id">Flavour</label>
                                            <select class="form-control" name="flavour_id">
                                                <option value="">Select Flavour</option>
                                                @foreach ($flavours as $value)
                                                    <option value="{{ $value->flavour_id }}"
                                                        {{ Request::get('flavour_id') == $value->flavour_id ? 'selected' : '' }}>
                                                        {{ $value->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <button class="btn btn-primary" style="margin-top:30px">Search</button>
                                            <a class="btn btn-success" style="margin-top:30px"
                                                href="/admin/product_details/index/{{$product_id}}">Reset</a>
                                            <a class="btn btn-secondary" style="margin-top:30px"
                                                href="/admin/product/">Back To Product List</a>
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
                                <h3 class="card-title">Detail List of Product Id: {{$product_id}} (Total: {{ $product_details->total() }})</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Size</th>
                                            <th>Flavour</th>
                                            <th>Price</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_details as $value)
                                            <tr>
                                                <td>{{ $value->product_details_id }}</td>
                                                <td><img src="{{ $value->image }}" alt="img"
                                                        class="img-fluid rounded-circle" style="width: 60px; height:60px">
                                                </td>
                                                <td>{{ $value->size }} </td>
                                                <td>{{ $value->flavour }} </td>
                                                <td>{{ $value->price }} $</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <a href="/admin/product_details/edit/{{ $value->product_details_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/product_details/delete/{{ $value->product_details_id }}"
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
                                    {!! $product_details->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
