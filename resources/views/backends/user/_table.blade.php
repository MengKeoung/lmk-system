<div class="card-body p-0 table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th >#</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('First Name') }}</th>
                <th>{{ __('Last Name') }}</th>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Email') }}</th>
                {{-- <th>Created by</th> --}}
                <th>{{ __('Created Date') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="
                        @if ($user->image && file_exists(public_path('uploads/users/' . $user->image)))
                            {{ asset('uploads/users/'. $user->image) }}
                        @else
                            {{ asset('uploads/default-profile.png') }}
                        @endif
                        " alt="" class="profile_img_table">
                    </td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y h:i A') }}</td>
                    <td>
                        @can('user.edit')
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info btn-sm btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                            {{ __('Edit') }}
                        </a>
                        @endcan
                        @can('user.destroy')

                        <form action="{{ route('admin.user.destroy', $user->id) }}" class="d-inline-block form-delete-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" data-id="{{ $user->id }}" data-href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-trash-alt"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="row">
        <div class="col-12 d-flex flex-row flex-wrap">
            <div class="row" style="width: -webkit-fill-available;">
                <div class="col-12 col-sm-6 text-center text-sm-left pl-3" style="margin-block: 20px">
                    {{ __('Showing') }} {{ $grades->firstItem() }} {{ __('to') }} {{ $grades->lastItem() }} {{ __('of') }} {{ $grades->total() }} {{ __('entries') }}
                </div>
                <div class="col-12 col-sm-6 pagination-nav pr-3"> {{ $grades->links() }}</div>
            </div>
        </div>
    </div> --}}


</div>
