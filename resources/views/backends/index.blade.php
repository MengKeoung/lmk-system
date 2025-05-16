@extends('backends.master')

@section('page_title')
    Admin Dashboard
@endsection

@push('css')
    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>
@endpush

@section('contents')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('Welcome')}}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row gx-3 gy-3">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box shadow p-3">
                        <div class="inner">
                            <h5>{{ __('Product') }}</h5>
                            {{-- <p>{{ $totalProducts }}</p> --}}
                        </div>
                        <div class="icon">
                            <i class="fa fa-cube"></i>
                        </div>
                    </div>
                </div>

                <!-- Customer Box -->
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box shadow p-3">
                        <div class="inner">
                            <h5>{{ __('Customer') }}</h5>
                            {{-- <p>{{ $totalCustomers }}</p> --}}
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Booking Box -->
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box shadow p-3">
                        <div class="inner">
                            <h5>{{ __('Total Booking') }}</h5>
                            {{-- <p>${{ $totalSales }}</p> --}}
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard"></i>
                        </div>
                    </div>
                </div>

                <!-- Today Booking Box -->
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="small-box shadow p-3">
                        <div class="inner">
                            <h5>{{ __('Today Booking') }}</h5>
                            {{-- <p>${{ number_format($todayTotalSales, 2) }}</p> --}}
                        </div>
                        <div class="icon">
                            <i class="far fa-clipboard"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
   
@endpush
