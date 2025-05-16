<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th >#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $expense->name }}</td>
                    <td>{{ $expense->date ? $expense->date->format('d M Y') : '' }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->note }}</td>
                    <td>
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.expenses.destroy', $expense->id) }}" class="d-inline-block form-delete-{{ $expense->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $expense->id }}" data-href="{{ route('admin.expenses.destroy', $expense->id) }}" class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $expenses->firstItem() }} {{ __('to') }} {{ $expenses->lastItem() }} {{ __('of') }} {{ $expenses->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $expenses->links() }}</div>
            </div>
        </div>
    </div> --}}


</div>
