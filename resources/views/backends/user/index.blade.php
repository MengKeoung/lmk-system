@extends('backends.master')

@push('css')
    <style>
        .preview {
            margin-block: 12px;
            text-align: center;
        }
        .tab-pane {
            margin-top: 20px
        }
    </style>
@endpush
@section('contents')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ __('User Management') }}</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h3 class="card-title">{{ __('User List') }}</h3>
                            </div>
                            {{-- <span class="badge bg-warning total-count">{{ $grades->total() }}</span> --}}
                            <div class="col-sm-6">
                                {{-- <a href="{{ au }}"></a> --}}
                                @can('user.create')
                                <a class="btn btn-primary float-right" href="{{ route('admin.user.create') }}">
                                    <i class=" fa fa-plus-circle"></i>
                                    {{ __('Add New') }}
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    {{-- table --}}
                    @include('backends.user._table')

                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade modal_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

@endsection
@push('js')
<script>
    $('.btn_add').click(function (e) {
        var tbody = $('.tbody');
        var numRows = tbody.find("tr").length;
        $.ajax({
            type: "get",
            url: window.location.href,
            data: {
                "key" : numRows
            },
            dataType: "json",
            success: function (response) {
                $(tbody).append(response.tr);
            }
        });
    });

    $('.custom-file-input').change(function (e) {
        var reader = new FileReader();
        var preview = $(this).closest('.form-group').find('.preview img');
        console.log(preview);
        reader.onload = function(e) {
            preview.attr('src', e.target.result).show();
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();

        const Confirmation = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        Confirmation.fire({
            title: '{{ __('Are you sure?') }}',
            text: @json(__('You won\'t be able to revert this!')),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __('Yes, delete it!') }}',
            cancelButtonText: '{{ __('No, cancel!') }}',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                console.log(`.form-delete-${$(this).data('id')}`);
                var data = $(`.form-delete-${$(this).data('id')}`).serialize();
                // console.log(data);
                $.ajax({
                    type: "post",
                    url: $(this).data('href'),
                    data: data,
                    // dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 1) {
                            $('.table-wrapper').replaceWith(response.view);
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg)

                        }
                    }
                });
            }
        });
    });

</script>
@endpush
