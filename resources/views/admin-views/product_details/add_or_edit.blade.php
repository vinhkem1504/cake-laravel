@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($product_details) ? 'Edit' : 'Add New' }} Detail</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/product_details/index/{{ $product_id }}" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($product_details) ? 'Edit' : 'Add' }} Product Detail
                                    Form</h3>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_id">Product Id<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $product_id }}" readonly class="form-control"
                                            name="product_id" id="product_id">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="image">Image <span class="text-danger">*</span></label>
                                        <div class="">
                                            <img src="{{ isset($product_details) ? $product_details->image : '' }}"
                                                id="image-upload" class="rounded mx-auto d-block" style="width: 256px" />
                                        </div>
                                        <span class="text">Chọn ảnh</span>
                                        <input type="file" class="form-control" name="ImageFile" id="exampleInputFile">
                                        <div style="color:red">{{ $errors->first('ImageFile') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="size_id"> Size <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="size_id">
                                            <option value="">Select Size</option>
                                            @foreach ($sizes as $value)
                                                <option value="{{ $value->size_id }}" {{ (old('size_id') == $value->size_id) ? 'selected' : ((isset($product_details) && $product_details->size_id == $value->size_id) ? 'selected' : '') }}>
                                                    {{ $value->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('size_id') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="flavour_id">Flavour <span class="text-danger">*</span></label>
                                        <select class="form-control" name="flavour_id">
                                            <option value="">Select Flavour</option>
                                            @foreach ($flavours as $value)
                                                <option value="{{ $value->flavour_id }}" {{ (old('flavour_id') == $value->flavour_id) ? 'selected' : ((isset($product_details) && $product_details->flavour_id == $value->flavour_id) ? 'selected' : '') }}>
                                                    {{ $value->value }}
                                                </option>                         
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <input type="text"
                                            value="{{ old('price', isset($product_details) ? $product_details->price : '') }}"
                                            required class="form-control" name="price" id="price"
                                            placeholder="Enter Price">
                                        <div style="color:red">{{ $errors->first('price') }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($product_details) ? 'Update' : 'Create' }}
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