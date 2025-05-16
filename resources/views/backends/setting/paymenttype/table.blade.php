<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        @foreach ($paymenttypes as $paymenttype)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paymenttype->name }}</td>
                <td>{{ $paymenttype->note }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm btn-edit-paymenttype" data-toggle="modal"
                        data-target="#editPaymentTypeModal" data-id="{{ $paymenttype->id }}" data-name="{{ $paymenttype->name }}"
                        data-note="{{ $paymenttype->note }}">
                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                    </button>

                    <form action="{{ route('admin.paymenttypes.destroy', $paymenttype->id) }}"
                        class="d-inline-block form-delete-{{ $paymenttype->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-id="{{ $paymenttype->id }}"
                            data-href="{{ route('admin.paymenttypes.destroy', $paymenttype->id) }}"
                            class="btn btn-danger btn-sm btn-delete">
                            <i class="fa fa-trash-alt"></i>
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $paymenttypes->firstItem() }} {{ __('to') }} {{ $paymenttypes->lastItem() }}
                    {{ __('of') }} {{ $paymenttypes->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $paymenttypes->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
