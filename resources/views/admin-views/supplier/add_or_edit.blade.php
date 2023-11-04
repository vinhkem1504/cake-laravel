@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($supplier) ? 'Edit' : 'Add New' }} Supplier</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/supplier" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($supplier) ? 'Edit' : 'Add' }} Supplier Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <input type="text" value="{{ isset($supplier) ? $supplier->name : '' }}" required class="form-control" name="name" id="name" placeholder="Enter name">
                                            <div style="color:red">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input type="tel" value="{{ isset($supplier) ? $supplier->phone : '' }}" required class="form-control" name="phone" id="phone" placeholder="Enter phone">
                                            <div style="color:red">{{ $errors->first('phone') }}</div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ isset($supplier) ? $supplier->address : '' }}" required class="form-control" name="address" id="address" placeholder="Enter address">
                                            <div style="color:red">{{ $errors->first('address') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($supplier) ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
