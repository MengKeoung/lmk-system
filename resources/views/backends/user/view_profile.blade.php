@extends('backends.master')

@section('contents')

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">{{ __('User Profile') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Card -->
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <!-- Profile Image -->
                                <div class="me-4">
                                    <img src="
                                    @if ($user->image && file_exists(public_path('uploads/users/' . $user->image)))
                                        {{ asset('uploads/users/' . $user->image) }}
                                    @else
                                        {{ asset('uploads/default-profile.png') }}
                                    @endif
                                    " alt="Profile Image" class="rounded-circle mr-3" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <!-- User Details -->
                                <div>
                                    <h2 class="h4 mb-1 text-primary font-weight-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
                                    <p class="text-muted mb-0">{{ $user->role ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="col-md-12 mt-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <!-- Section Header -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="h5 mb-0">{{__('Personal Information')}}</h3>
                                <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                    <span>{{__('Edit')}}</span>
                                    <i class="fas fa-edit ms-2 ml-1"></i>
                                </a>
                            </div>
                            <!-- User Details Grid -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 rounded">
                                        <strong class="d-block text-muted small">{{__('First Name')}}</strong>
                                        <p class="mb-0">{{ $user->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 rounded">
                                        <strong class="d-block text-muted small">{{__('Last Name')}}</strong>
                                        <p class="mb-0">{{ $user->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 rounded">
                                        <strong class="d-block text-muted small">{{__('Email')}}</strong>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 rounded">
                                        <strong class="d-block text-muted small">{{__('Phone')}}</strong>
                                        <p class="mb-0">{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bg-light p-3 rounded">
                                        <strong class="d-block text-muted small">{{__('User Role')}}</strong>
                                        <p class="mb-0">{{ $user->role ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
