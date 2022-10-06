@extends('layouts.dashboard')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Create New Employee</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" class="ajax_form" action="{{ route('admin.employee.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="first_name" class="font-light text-gray-500">First Name</label>
                                            <input type="text" id="first_name" name="first_name"
                                                   class="form-control rounded border-1 border-gray-300">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last_name" class="font-light text-gray-500">Last Name</label>
                                            <input type="text" id="last_name" name="last_name"
                                                   class="form-control rounded border-1 border-gray-300">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="first_name" class="font-light text-gray-500">Email</label>
                                            <input type="text" id="email" name="email"
                                                   class="form-control rounded border-1 border-gray-300">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone" class="font-light text-gray-500">Phone</label>
                                            <input type="text" id="phone" name="phone"
                                                   class="form-control rounded border-1 border-gray-300">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <select id="company" name="company_id" class="js_select select2 form-control">
                                        <option value="" disabled selected>Choose Company</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary text-gray-700">Create Record</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->

                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    @push('css_before')
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush

    @push('js_after')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $(function () {
                $('.select2').select2();
            });

            $.get("{{ route('admin.get-all-companies') }}", function (response) {
                let options = "";

                $.each(response, function (i) {
                    options += `<option value="${response[i]['id']}"> ${response[i]['name']} </option>`;
                });

                $('#company').append(options);
            });


            $('.ajax_form').submit( function (e) {
                ajaxRequest(e);
            })

        </script>
    @endpush

@endsection
