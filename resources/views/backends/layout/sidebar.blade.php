<aside class="main-sidebar elevation-4 sidebar-light-primary" style="">
    <!-- Brand Logo -->
    @php
        $web_header_logo = \App\Models\BusinessSetting::where('type', 'web_header_logo')->first()->value;
    @endphp
    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="">
        <img src="@if ($web_header_logo && file_exists('uploads/business_settings/' . $web_header_logo)) {{ asset('uploads/business_settings/' . $web_header_logo) }}
        @else
        {{ asset('images/no_image_available.jpg') }} @endif"
            alt="AdminLTE Logo" class="brand-image"
            style="width: 100%;
      object-fit: contain;margin-left: 0; height: 100px;max-height: 72px;">
        {{-- <span class="brand-text font-weight-light">ONLINE SHOP</span> --}}
    </a>



    <!-- Sidebar -->
    <div class="sidebar os-theme-dark">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ Session::get('current_user')->profile_photo_path }}" class="img-circle elevation-2"
                    alt="User Image"> --}}
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">{{ Session::get('current_user')->name }}</a> --}}
            </div>
        </div>
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input style="background-color: #012e5a;" class="form-control form-control-sidebar" type="search"
                    placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif">
                        {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                        @include('svgs.dashboard')
                        <p>
                            {{ __('Dashboard') }}

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Product') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Category') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.customers.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Customer') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.suppliers.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Supplier') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.allsales.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('All Sale') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.expenses.index') }}"
                        class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Expense') }}
                        </p>
                    </a>
                </li>
                @if (auth()->user()->can('user.view') || auth()->user()->can('role.view'))
                    <li class="nav-item @if (request()->routeIs('admin.user*', 'admin.roles*')) menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link @if (request()->routeIs('admin.user*', 'admin.roles*')) active @endif">
                            {{-- <i class="nav-icon fa fa-users"></i> --}}
                            @include('svgs.users')
                            <p>
                                {{ __('User Management') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->can('user.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.user.index') }}"
                                        class="nav-link @if (request()->routeIs('admin.user*')) active @endif">
                                        <i class="fa-solid fa-circle nav-icon"></i>
                                        <p>
                                            {{ __('Users') }}
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('role.view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link @if (request()->routeIs('admin.roles*')) active @endif">
                                        <i class="fa-solid fa-circle nav-icon"></i>
                                        <p>
                                            {{ __('Role') }}
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->can('setting.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index') }}"
                            class="nav-link @if (request()->routeIs('admin.setting*')) active @endif">
                            {{-- <i class="nav-icon fas fa-cog"></i> --}}
                            @include('svgs.setting')
                            <p>
                                {{ __('Setting') }}
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
