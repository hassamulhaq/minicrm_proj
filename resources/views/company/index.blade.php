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
                            <h3 class="card-title">Companies list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th style="width: 40px">Email</th>
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {!! $companies->appends(['sort' => 'asc'])->links() !!}
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
        <link rel="stylesheet" href="{{ asset("plugins/dropzone/dropzone.css") }}" />
    @endpush

    @push('js_before')
        <script src="{{ asset("plugins/dropzone/min/dropzone.min.js") }}"></script>
    @endpush

@endsection
