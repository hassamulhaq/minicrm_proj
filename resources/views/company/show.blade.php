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
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8 offset-md-2">
                    <!-- general form elements -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-secondary">
                            <h2 class="widget-user-username mb-2">
                                {{ Str::title($company->name) }}
                            </h2>
                            <a href="{{ route('admin.company.edit', $company) }}" class="float-right text-sm ml-2 btn btn-xs btn-outline-info">{{ __('Edit') }}</a>
                            <h5 class="widget-user-desc text-sm">{{ __('Created At') }} {{ \Carbon\Carbon::parse($company->created_at)->format('Y-m-d') }}</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ !is_null($company->logo) ? $company->logo : \App\Helpers\Constants::PLACEHOLDER_IMAGE }}" alt="Logo">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $company->email ?? __('N/A') }}</h5>
                                        <span class="description-text">{{ __('Email') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $company->employees->count() }}</h5>
                                        <span class="description-text">{{ __('Employees') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $company->id }}</h5>
                                        <span class="description-text">{{ __('UUID') }}</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

