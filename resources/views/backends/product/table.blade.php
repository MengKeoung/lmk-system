<div class="card-body p-0 table-wrapper">
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Product Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Cost') }}</th>
                    <th>{{ __('Unit Price') }}</th>
                    <th>{{ __('Whole Price') }}</th>
                    <th>{{ __('Discount') }}</th>
                    <th>{{ __('Inventory') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>{{ $product->unit_price }}</td>
                        <td>{{ $product->whole_price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->inventory }}</td>
                        <td>
                            <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input switcher_input status"
                                            id="status_{{ $product->id }}"
                                            data-id="{{ $product->id }}"
                                            {{ $product->status == '1' ? 'checked' : '' }}
                                            name="status">
                                        <label class="custom-control-label"
                                            for="status_{{ $product->id }}"></label>
                                    </div>
                        </td>
                        <td>
                            <img src="@if ($product->image && file_exists(public_path('upload/products/' . $product->image))) {{ asset('upload/products/' . $product->image) }}
                                     @else
                                        {{ asset('upload/image/default_image.png') }} @endif"
                                alt="Product Image" class="profile_img_table" style="max-height: 50px;">
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" class="d-inline-block form-delete-{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $product->id }}" data-href="{{ route('admin.products.destroy', $product->id) }}" class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row w-100">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3 my-2">
                    {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }}
                    {{ __('of') }} {{ $products->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3 my-2">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
