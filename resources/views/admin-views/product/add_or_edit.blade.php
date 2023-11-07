@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($product) ? 'Edit' : 'Add New' }} Product</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/product" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($product) ? 'Edit' : 'Add' }} Product Form</h3>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="productname">Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('productname', isset($product) ? $product->productname : '') }}"
                                            required class="form-control" name="productname" id="productname"
                                            placeholder="Enter name">
                                        <div style="color:red">{{ $errors->first('productname') }}</div>
                                    </div>
                                    <div class="from-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->category_id }}" {{ (old('category_id') == $value->category_id) ? 'selected' : ((isset($product) && $product->category_id == $value->category_id) ? 'selected' : '') }}>
                                                    {{ $value->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="product_avt_iamge">Image <span class="text-danger">*</span></label>
                                        <div class="">
                                            <img src="{{ isset($product) ? $product->product_avt_iamge : '' }}"
                                                id="image-upload" class="rounded mx-auto d-block" style="width: 256px" />
                                        </div>
                                        <span class="text">Chọn ảnh</span>
                                        <input type="file" class="form-control" name="ImageFile" id="exampleInputFile">
                                        <div style="color:red">{{ $errors->first('ImageFile') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="info">Info</label>
                                        <textarea class="form-control" name="info" id="info">{{ old('info', isset($product) ? $product->info : '') }}</textarea>
                                        <div style="color: red">{{ $errors->first('info') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="info">Price Default <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('price_default', isset($product) ? $product->price_default : '') }}"
                                            required class="form-control" name="price_default" id="price_default">
                                        <div style="color:red">{{ $errors->first('price_default') }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($product) ? 'Update' : 'Create' }}
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


@section('script')
    <script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#info').summernote({
                height: 400,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'picture']],
                    ['misc', ['codeview']],
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exampleInputFile').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-upload').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endsection
