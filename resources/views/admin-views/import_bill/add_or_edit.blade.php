@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($import_bill) ? 'Edit' : 'Add New' }} Import Bill</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/import_bill" class="btn btn-primary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ isset($import_bill) ? 'Edit' : 'Add' }} Import Bill Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="date">Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            value="{{ isset($import_bill) ? date('Y-m-d', strtotime($import_bill->date)) : '' }}"
                                            required class="form-control" name="date" id="date"
                                            placeholder="Enter date">
                                        {{-- <div style="color:red">{{ $errors->first('date') }}</div> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier_id"> Supplier <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $value)
                                                <option value="{{ $value->supplier_id }}"
                                                    {{ isset($import_bill) && $import_bill->supplier_id == $value->supplier_id ? 'selected' : '' }}>
                                                    {{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <div style="color:red">{{ $errors->first('supplier_id') }}</div> --}}
                                    </div>


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($import_bill) ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Import Bill ID: {{ isset($import_bill) ? $import_bill->import_bill_id : '' }} (Total: {{ $details_import_bills->total() }} / Total Price: {{ $total }} $)</h3>
                                <a href="/admin/details_import_bill/add/{{$import_bill->import_bill_id}}" class="btn btn-primary float-right">Add New Detail</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Material</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details_import_bills as $value)
                                            <tr>
                                                <td>{{ $value->details_import_bill_id }}</td>
                                                <td>{{ $value->material_name }}</td>
                                                <td> {{ $value->quantity }} </td>
                                                <td> {{ $value->price }} $</td>
                                                <td> {{ $value->price * $value->quantity }} $</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <a href="/admin/details_import_bill/edit/{{ $value->details_import_bill_id }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="/admin/details_import_bill/delete/{{ $value->details_import_bill_id }}"
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
                                    {!! $details_import_bills->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
