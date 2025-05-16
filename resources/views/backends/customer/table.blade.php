<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th >#</th>
                <th>{{__('Customer Code')}}</th>
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
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->customer_code }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->note }}</td>
                    <td>
                        <img src="
                        @if ($customer->image && file_exists(public_path('upload/customers/' . $customer->image)))
                            {{ asset('upload/customers/'. $customer->image) }}
                        @else
                            {{ asset('upload/image/default_image.png') }}
                        @endif
                        " alt="customer Image" class="profile_img_table">
                    </td>
                    <td>
                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" class="d-inline-block form-delete-{{ $customer->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $customer->id }}" data-href="{{ route('admin.customers.destroy', $customer->id) }}" class="btn btn-danger btn-sm btn-delete">
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
                    {{ __('Showing') }} {{ $customers->firstItem() }} {{ __('to') }} {{ $customers->lastItem() }} {{ __('of') }} {{ $customers->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $customers->links() }}</div>
            </div>
        </div>
    </div>
</div>
