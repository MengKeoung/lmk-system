<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th >#</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Note') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->note }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" class="d-inline-block form-delete-{{ $category->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $category->id }}" data-href="{{ route('admin.categories.destroy', $category->id) }}" class="btn btn-danger btn-sm btn-delete">
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
                    {{ __('Showing') }} {{ $categories->firstItem() }} {{ __('to') }} {{ $categories->lastItem() }} {{ __('of') }} {{ $categories->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $categories->links() }}</div>
            </div>
        </div>
    </div>


</div>
