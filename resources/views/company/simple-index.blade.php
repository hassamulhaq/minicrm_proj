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
                            <div id="datatable-wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <table class="table table-sm table-bordered table-hover dataTable dtr-inline DataTable">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No. of Employees</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td> {{ $loop->index }} </td>
                                            <td>
                                                <img width="40" src="{{ !is_null($company->logo) ? $company->logo : \App\Helpers\Constants::PLACEHOLDER_IMAGE }}" alt="Logo">
                                            </td>
                                            <td> {{ $company->name }} </td>
                                            <td> {{ $company->email }} </td>
                                            <td> {{ $company->employees->count() }} </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.company.show', $company) }}" class="btn btn-sm btn-outline-success">Show</a>
                                                    <a href="{{ route('admin.company.edit', $company) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                                    <form class="form-inline border-0 rounded-0" action="{{ route('admin.company.destroy', $company->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <input type="hidden" name="id" value="{{ $company->id }}">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-0">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <style>
            .dt-buttons button {
                background-color: #6c757d !important;
                border-color: #6c757d !important;
            }
        </style>
    @endpush

    @push('js_after')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            $(function () {
                $(".DataTable").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#datatable-wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush

@endsection
