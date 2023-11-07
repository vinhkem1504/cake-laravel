@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($category) ? 'Edit' : 'Add New' }} Category</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/category" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($category) ? 'Edit' : 'Add' }} Category Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_name">Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('category_name', isset($category) ? $category->category_name : '') }}" required class="form-control" name="category_name" id="category_name" placeholder="Enter name">
                                        <div style="color:red">{{ $errors->first('category_name') }}</div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($category) ? 'Update' : 'Create' }}
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
