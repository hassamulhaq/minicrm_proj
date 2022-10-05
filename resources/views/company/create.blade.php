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
                            <h3 class="card-title">Create New Company</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('admin.company.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="font-light text-gray-500">Name</label>
                                    <input type="text" id="name" name="name" class="form-control rounded border-1 border-gray-300">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control rounded border-1 border-gray-300">
                                </div>
                                <div class="form-group">
                                    <label for="company_logo">Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="company_logo" class="custom-file-input" id="company_logo">
                                            <label class="custom-file-label" for="company_logo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary text-gray-700">Create</button>
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

    @push('js_after')
        <script src="{{ asset("plugins/bs-custom-file-input/bs-custom-file-input.js") }}"></script>
        <script>
            $(function () {
                bsCustomFileInput.init();
            });
        </script>
    @endpush

@endsection
