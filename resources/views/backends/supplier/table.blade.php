<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th >#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Address') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->note }}</td>
                    <td>
                        <img src="
                        @if ($supplier->image && file_exists(public_path('upload/suppliers/' . $supplier->image)))
                            {{ asset('upload/suppliers/'. $supplier->image) }}
                        @else
                            {{ asset('upload/image/default_image.png') }}
                        @endif
                        " alt="supplier Image" class="profile_img_table">
                    </td>
                    <td>
                        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" class="d-inline-block form-delete-{{ $supplier->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $supplier->id }}" data-href="{{ route('admin.suppliers.destroy', $supplier->id) }}" class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $suppliers->firstItem() }} {{ __('to') }} {{ $suppliers->lastItem() }} {{ __('of') }} {{ $suppliers->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $suppliers->links() }}</div>
            </div>
        </div>
    </div>


</div>
