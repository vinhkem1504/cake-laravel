@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($details_import_bill) ? 'Edit' : 'Add New' }} Details</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <a href="/admin/import_bill/edit/{{ $import_bill_id }}" class="btn btn-primary">Back to List</a>
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
                                <h3 class="card-title">{{ isset($details_import_bill) ? 'Edit' : 'Add' }} Import Bill Detail
                                    Form</h3>
                            </div>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="import_bill_id">Import Bill ID<span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $import_bill_id }}" readonly class="form-control"
                                            name="import_bill_id" id="import_bill_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="material_id"> Material <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="material_id">
                                            <option value="">Select Material</option>
                                            @foreach ($materials as $value)
                                                <option value="{{ $value->material_id }}" {{ (old('material_id') == $value->material_id) ? 'selected' : ((isset($details_import_bill) && $details_import_bill->material_id == $value->material_id) ? 'selected' : '') }}>
                                                    {{ $value->material_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('material_id') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity<span class="text-danger">*</span></label>
                                        <input type="number"
                                            value="{{ old('quantity', isset($details_import_bill) ? $details_import_bill->quantity : '') }}"
                                            required class="form-control" name="quantity" id="quantity"
                                            placeholder="Enter quantity">
                                        <div style="color:red">{{ $errors->first('quantity') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price <span class="text-danger">*</span></label>
                                        <input type="text"
                                            value="{{ old('price', isset($details_import_bill) ? $details_import_bill->price : '') }}"
                                            required class="form-control" name="price" id="price"
                                            placeholder="Enter price">
                                        <div style="color:red">{{ $errors->first('price') }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($details_import_bill) ? 'Update' : 'Create' }}
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
