@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">App</span> Settings
            </h5>
        </div>
    </div>

    <!-- Settings Form -->
    <div class="card">
        <div class="card-body">

            <form action="{{ route('super.admin.setting.update') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Admin Email -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Admin Email <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               name="admin_email"
                               class="form-control"
                               placeholder="Enter admin email"
                               value="{{ old('admin_email', $setting->admin_email ?? '') }}"
                               required>
                        @error('admin_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        Save Settings
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('script')
@endsection
