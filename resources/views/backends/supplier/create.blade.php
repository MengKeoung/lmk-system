@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create Supplier') }}</h1>
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
                        <form method="POST" action="{{ route('admin.suppliers.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('Name') }}</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" name="name"
                                            placeholder="{{ __('Enter Supplier Name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email"
                                            placeholder="{{ __('Enter Your Email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>{{ __('Phone') }}</label>
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" name="phone"
                                            placeholder="{{ __('Enter your Phone Number') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>{{ __('Address') }}</label>
                                        <input type="address" class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address') }}" name="address"
                                            placeholder="{{ __('Enter Your Address') }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">{{__('Image')}}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                                <label class="custom-file-label" for="exampleInputFile">{{ __('Choose file') }}</label>
                                            </div>
                                        </div>
                                        <div class="preview text-center border rounded mt-2" style="height: 150px">
                                            <img src="{{ asset('upload/image/default.png') }}" alt="" height="100%">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('Note') }}</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note') }}</textarea>
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
@push('js')
    <script>
        $('.custom-file-input').change(function (e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endpush