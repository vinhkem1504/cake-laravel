@extends('layouts.admin')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Statistic</h1>
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
                                <h3 class="card-title">Statistic</h3>
                            </div>
                            <form method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="status">Type</label>
                                            <select class="form-control" name="type" id="type">
                                                <option value="1" @if (Request::get('type') == 1 || Request::get('type') == null) selected @endif>
                                                    Bill</option>
                                                <option value="2" @if (Request::get('type') == 2) selected @endif>
                                                    Import Bill</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date"
                                                value="{{ Request::get('start_date') }}" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control" name="end_date" id="end_date"
                                                value="{{ Request::get('end_date') }}" />
                                        </div>

                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top:30px">Filter</button>
                                            <a class="btn btn-success" style="margin-top:30px"
                                                href="/admin/statistic/index">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách hóa đơn</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    @if (isset($bills))
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>User Id</th>
                                                <th>Date</th>
                                                <th>Phone</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills as $value)
                                                <tr>
                                                    <td><a
                                                            href="/admin/bill/{{ $value->bill_id }}">{{ $value->bill_id }}</a>
                                                    </td>
                                                    <td>{{ $value->user_id }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                                    <td>{{ $value->phone_number }}</td>
                                                    <td>{{ $value->total_price }} $</td>
                                                    <td>
                                                        @if ($value->status == 0)
                                                            <span class="badge badge-pill badge-primary">Pending</span>
                                                        @elseif ($value->status == 1)
                                                            <span class="badge badge-pill badge-success">Delivered</span>
                                                        @elseif ($value->status == 2)
                                                            <span class="badge badge-pill badge-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                    @if (isset($import_bills))
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($import_bills as $value)
                                                <tr>
                                                    <td>{{ $value->import_bill_id }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                                    <td> {{ $value->supplier_name }} </td>
                                                    <td> {{ $value->total_price }} $</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/plugins/jszip/jszip.min.js"></script>
    <script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
