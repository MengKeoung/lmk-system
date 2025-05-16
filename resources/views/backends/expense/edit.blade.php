@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Expense') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <form method="POST" action="{{ route('admin.expenses.update', $expense->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 ">
                                        <label class="required_lable">{{ __('Name') }}</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $expense->name) }}" name="name"
                                            placeholder="{{ __('Enter Expense Name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label class="required_lable">{{ __('Amount') }}</label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                            value="{{ old('amount', $expense->amount) }}" name="amount"
                                            placeholder="{{ __('Input Expense Amount') }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required_lable">{{ __('Date') }}</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date', isset($expense->date) ? $expense->date->format('Y-m-d') : '') }}"
                                            name="date" placeholder="{{ __('Select Expense Date') }}">

                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{ __('Note') }}</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note', $expense->note) }}</textarea>
                                        @error('note')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
