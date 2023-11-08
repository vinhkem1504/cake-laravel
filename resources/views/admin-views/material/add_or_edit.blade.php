@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($material) ? 'Edit' : 'Add New' }} Material</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/material" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($material) ? 'Edit' : 'Add' }} Material Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="material_name">Name<span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('material_name', isset($material) ? $material->material_name : '') }}" required class="form-control" name="material_name" id="material_name" placeholder="Enter name">
                                            <div style="color:red">{{ $errors->first('material_name') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Unit <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('unit', isset($material) ? $material->unit : '') }}" required class="form-control" name="unit" id="unit" placeholder="Enter unit">
                                            <div style="color:red">{{ $errors->first('unit') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($material) ? 'Update' : 'Create' }}
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
