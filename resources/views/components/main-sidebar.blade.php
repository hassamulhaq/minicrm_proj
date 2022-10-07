<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset("images/AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset("images/user1-128x128.jpg") }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                <li class="nav-header">Menus</li>



                <li class="nav-item">
                    <a href="{{ route('admin.company.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>
                            {{ __('Companies') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.company.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List Companies') }}</p>
                            </a>
                            <a href="{{ route('admin.company.simple-companies') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List Companies DT') }}</p>
                            </a>

                            <a href="{{ route('admin.company.serverside-companies') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List Companies SS') }}</p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.company.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Create New') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.employee.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>
                            {{ __('Employees') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.employee.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('List Employees') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.employee.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Employee New') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p><button type="submit" class="text">{{ __('Log Out') }}</button></p>
                        </form>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
