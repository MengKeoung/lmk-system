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
        @foreach ($measures as $measure)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $measure->name }}</td>
                <td>{{ $measure->note }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm btn-edit" data-toggle="modal"
                        data-target="#editMeasureModal" data-id="{{ $measure->id }}" data-name="{{ $measure->name }}"
                        data-note="{{ $measure->note }}">
                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                    </button>

                    <form action="{{ route('admin.measures.destroy', $measure->id) }}"
                        class="d-inline-block form-delete-{{ $measure->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-id="{{ $measure->id }}"
                            data-href="{{ route('admin.measures.destroy', $measure->id) }}"
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
                    {{ __('Showing') }} {{ $measures->firstItem() }} {{ __('to') }} {{ $measures->lastItem() }}
                    {{ __('of') }} {{ $measures->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $measures->links() }}</div>
            </div>
        </div>
    </div> --}}
</div>
