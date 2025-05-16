@extends('backends.master')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Product') }}</h1>
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
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <li class="nav-item">
                                                        <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                                            id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                                            href="#lang_{{ $lang['code'] }}" data-lang="{{ $lang['code'] }}"
                                                            role="tab" aria-controls="lang_{{ $lang['code'] }}"
                                                            aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" id="custom-content-below-tabContent">
                                            @foreach (json_decode($language, true) as $lang)
                                                @if ($lang['status'] == 1)
                                                    <?php
                                                    if (count($product['translations'])) {
                                                        $translate = [];
                                                        foreach ($product['translations'] as $t) {
                                                            if ($t->locale == $lang['code'] && $t->key == 'name') {
                                                                $translate[$lang['code']]['name'] = $t->value;
                                                            }
                                                            if ($t->locale == $lang['code'] && $t->key == 'description') {
                                                                $translate[$lang['code']]['description'] = $t->value;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-3"
                                                        id="lang_{{ $lang['code'] }}" role="tabpanel"
                                                        aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                                        <div class="form-group">
                                                            <input type="hidden" name="lang[]"
                                                                value="{{ $lang['code'] }}">
                                                            <label
                                                                for="name_{{ $lang['code'] }}">{{ __('Name') }}({{ strtoupper($lang['code']) }})</label>
                                                            <input type="name" id="name_{{ $lang['code'] }}"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name[]" placeholder="{{ __('Enter Name') }}"
                                                                value="{{ $translate[$lang['code']]['name'] ?? $product['name'] }}">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card no_translate_wrapper">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('General Info') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Category') }}</label>
                                        <select name="category_id"
                                            class="form-control select2 @error('category_id') is-invalid @enderror"
                                            id="category_id">
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required_lable">{{ __('Measure') }}</label>
                                        <select name="measure_id"
                                            class="form-control select2 @error('measure_id') is-invalid @enderror"
                                            id="measure_id">
                                            <option value="">{{ __('Select Measure') }}</option>
                                            @foreach ($measures as $measure)
                                                <option value="{{ $measure->id }}"
                                                    {{ old('measure_id', $product->measure_id) == $measure->id ? 'selected' : '' }}>
                                                    {{ $measure->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('measure_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('Cost') }}</label>
                                        <input type="number" class="form-control @error('cost') is-invalid @enderror"
                                            value="{{ old('cost', $product->cost) }}" name="cost"
                                            placeholder="{{ __('Input Cost') }}">
                                        @error('cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('Unit Price') }}</label>
                                        <input type="number" class="form-control @error('unit_price') is-invalid @enderror"
                                            value="{{ old('unit_price', $product->unit_price) }}" name="unit_price"
                                            placeholder="{{ __('Input Unit Price') }}">
                                        @error('unit_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('Whole Price') }}</label>
                                        <input type="number"
                                            class="form-control @error('whole_price') is-invalid @enderror"
                                            value="{{ old('whole_price', $product->whole_price) }}" name="whole_price"
                                            placeholder="{{ __('Input Whole Price') }}">
                                        @error('whole_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label class="required_lable">{{ __('Inventory') }}</label>
                                        <input type="number" class="form-control @error('inventory') is-invalid @enderror"
                                            value="{{ old('inventory', $product->inventory) }}" name="inventory"
                                            placeholder="{{ __('Input Inventory') }}">
                                        @error('inventory')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Discount Type') }}</label>
                                        <select name="discount_type"
                                            class="form-control @error('discount_type') is-invalid @enderror"
                                            id="discount_type">
                                            <option value="">{{ __('Select Discount Type') }}</option>
                                            <option value="percentage"
                                                {{ old('discount_type', $product->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                {{ __('Percentage') }}
                                            </option>
                                            <option value="fixed"
                                                {{ old('discount_type', $product->discount_type) == 'fixed' ? 'selected' : '' }}>
                                                {{ __('Fixed') }}
                                            </option>
                                        </select>
                                        @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>{{ __('Discount') }}</label>
                                        <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                            value="{{ old('discount', $product->discount) }}" name="discount"
                                            placeholder="{{ __('Input Discount Amount') }}">
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status"
                                            class="form-control @error('status') is-invalid @enderror"
                                            id="status">
                                            <option value="1"
                                                {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                                {{ __('Active') }}
                                            </option>
                                            <option value="0"
                                                {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                                {{ __('Inactive') }}
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label>{{ __('Low Stock') }}</label>
                                        <input type="number" class="form-control @error('low_stock_threshold') is-invalid @enderror"
                                            value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}" name="low_stock_threshold"
                                            placeholder="{{ __('Input Low Stock Threshold') }}">
                                        @error('low_stock_threshold')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">{{ __('Image') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="image">
                                                <label class="custom-file-label"
                                                    for="exampleInputFile">{{ $product->image ?? __('Choose file') }}</label>
                                            </div>
                                        </div>
                                        <div class="preview text-center border rounded mt-2" style="height: 150px">
                                            <img src="
                                                @if ($product->image && file_exists(public_path('upload/products/' . $product->image))) {{ asset('upload/products/' . $product->image) }}
                                                @else
                                                    {{ asset('upload/image/default.png') }} @endif
                                                "
                                                alt="" height="100%">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>{{ __('Note') }}</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note', $product->note) }}</textarea>
                                        @error('note')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="fa fa-save"></i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('js')
    <script>
        $('.custom-file-input').change(function(e) {
            var reader = new FileReader();
            var preview = $(this).closest('.form-group').find('.preview img');
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.nav-tabs .nav-link', function(e) {
            if ($(this).data('lang') != 'en') {
                $('.no_translate_wrapper').addClass('d-none');
            } else {
                $('.no_translate_wrapper').removeClass('d-none');
            }
        });
    </script>
@endpush
