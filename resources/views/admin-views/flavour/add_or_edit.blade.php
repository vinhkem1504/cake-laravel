@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($flavour) ? 'Edit' : 'Add New' }} Flavour</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/flavour" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($flavour) ? 'Edit' : 'Add' }} Flavour Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="value">Value <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('value', isset($flavour) ? $flavour->value : '') }}" required class="form-control" name="value" id="value" placeholder="Enter name">
                                        <div style="color:red">{{ $errors->first('value') }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($flavour) ? 'Update' : 'Create' }}
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
