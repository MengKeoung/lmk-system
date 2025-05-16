@extends('backends.master')

@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Card Container -->
                        <div class="card shadow-sm border-0 mt-4"> <!-- Added mt-4 for top margin -->
                            <div class="card-body p-5">
                                <!-- Form Header -->
                                <h2 class="h4 text-center mb-4">{{__('Edit Profile')}}</h2>

                                <!-- Form Fields -->
                                <div class="row">
                                    <!-- Column 1 -->
                                    <div class="col-md-6">
                                        <!-- Email Field -->
                                        <div class="mb-4">
                                            <label for="email" class="form-label small text-muted">{{__('Email')}}</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- First Name Field -->
                                        <div class="mb-4">
                                            <label for="first_name" class="form-label small text-muted">{{__('First Name')}}</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control form-control-lg"
                                                value="{{ old('first_name', $user->first_name) }}" required>
                                            @error('first_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Phone Field -->
                                        <div class="mb-4">
                                            <label for="phone" class="form-label small text-muted">{{__('Phone')}}</label>
                                            <input type="text" id="phone" name="phone" class="form-control form-control-lg"
                                                value="{{ old('phone', $user->phone) }}" required>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Profile Picture Field -->
                                        <div class="mb-4">
                                            <label for="image">{{ __('Image') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                                            </div>
                                        </div>
                                        <div class="preview text-center border rounded mt-2" style="height: 150px">
                                            <img src="
                                                @if ($user->image && file_exists(public_path('uploads/users/' . $user->image)))
                                                    {{ asset('uploads/users/' . $user->image) }}
                                                @else
                                                    {{ asset('uploads/default-image.png') }}
                                                @endif
                                            " alt="" height="100%">
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <!-- Column 2 -->
                                    <div class="col-md-6">
                                        <!-- Password Field -->
                                        <div class="mb-4">
                                            <label for="password" class="form-label small text-muted">{{__('Password')}}</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Last Name Field -->
                                        <div class="mb-4">
                                            <label for="last_name" class="form-label small text-muted">{{__('Last Name')}}</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control form-control-lg"
                                                value="{{ old('last_name', $user->last_name) }}" required>
                                            @error('last_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Telegram Field -->
                                        <div class="mb-4">
                                            <label for="telegram" class="form-label small text-muted">{{__('Telegram')}}</label>
                                            <input type="text" id="telegram" name="telegram" class="form-control form-control-lg"
                                                value="{{ old('telegram', $user->telegram) }}" required>
                                            @error('telegram')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg py-3">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('profile-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
