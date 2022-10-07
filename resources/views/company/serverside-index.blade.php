@extends('layouts.dashboard')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Companies list (DataTable)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="datatable-wrapper" class="dataTables_wrapper dt-bootstrap4 overflow-x-auto">
                                <table class="table table-sm table-bordered table-hover dataTable dtr-inline DataTable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No. of Employees</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="js_serverside_tbody"></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    @push('css_after')
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    @endpush

    @push('js_after')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.DataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('api.company.serverside-companies-render') }}",
                    "columns": [
                        { "data": "id",  "name": 'id' },
                        { "data": "logo" },
                        { "data": "name" },
                        { "data": "email" },
                        { "data": "employees_count" },
                        {
                            "data": 'action',
                            "name": 'action',
                            "orderable": true,
                            "searchable": true
                        }
                    ]
                });
            });
        </script>
    @endpush

@endsection
