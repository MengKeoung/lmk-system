<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Symbol') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        @foreach ($currencies as $currency)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $currency->name }}</td>
                <td>{{ $currency->symbol }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm btn-edit-currency" data-toggle="modal"
                        data-target="#editCurrencyModal" data-id="{{ $currency->id }}" data-name="{{ $currency->name }}"
                        data-symbol="{{ $currency->symbol }}">
                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                    </button>

                    <form action="{{ route('admin.currencies.destroy', $currency->id) }}"
                        class="d-inline-block form-delete-{{ $currency->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-id="{{ $currency->id }}"
                            data-href="{{ route('admin.currencies.destroy', $currency->id) }}"
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
                    {{ __('Showing') }} {{ $currencies->firstItem() }} {{ __('to') }} {{ $currencies->lastItem() }}
                    {{ __('of') }} {{ $currencies->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $currencies->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
