@extends('admin.layouts.login_layout') 
@section('content') 

<style>
.authentication-inner {
    max-width: 74% !important;
}
</style>

<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

        <div class="card">
            <div class="card-body">

                <div class="app-brand justify-content-center mb-3">
                    <a href="{{ route('home') }}" class="app-brand-link gap-2">
                        <span class="fw-bolder">Training CRM</span>
                    </a>
                </div>

                <h4 class="text-center">Create Account 🚀</h4>

                <form method="POST" action="{{ route('company.register.post') }}">
                    @csrf

                    <div class="row">

                        <!-- Name -->
                        <div class="mb-3 col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div class="mb-3 col-md-6">
                            <label>Company Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}"
                                class="form-control @error('company_name') is-invalid @enderror">
                            @error('company_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mobile -->
                        <div class="mb-3 col-md-6">
                            <label>Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                class="form-control @error('mobile') is-invalid @enderror">
                            @error('mobile')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3 col-md-12">
                            <label>Address</label>
                            <textarea name="address"
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="mb-3 col-md-4">
                            <label>City</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                class="form-control @error('city') is-invalid @enderror">
                        </div>

                        <!-- State -->
                        <div class="mb-3 col-md-4">
                            <label>State</label>
                            <input type="text" name="state" value="{{ old('state') }}"
                                class="form-control @error('state') is-invalid @enderror">
                        </div>

                        <!-- Country -->
                        <div class="mb-3 col-md-4">
                            <label>Country</label>
                            <input type="text" name="country" value="{{ old('country','India') }}"
                                class="form-control">
                        </div>

                        <!-- Password -->
                        <div class="mb-3 col-md-6">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>


                        <!-- HOD -->
                        <div class="mb-3 col-md-6">
                            <label>HOD Name</label>
                            <input type="text" name="hod_name" value="{{ old('hod_name') }}"
                                class="form-control @error('hod_name') is-invalid @enderror">
                            @error('hod_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 col-md-6">
                            <label>HOD Email</label>
                            <input type="email" name="hod_email" value="{{ old('hod_email') }}"
                                class="form-control @error('hod_email') is-invalid @enderror">
                            @error('hod_email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <button class="btn btn-primary w-100">Register</button>

                </form>

                <!-- Login Redirect -->
                <p class="text-center mt-2 mb-2">
                    <span>Already have an account?</span>
                    <a href="{{ route('company.login') }}">
                        <span>Login here</span>
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

@endsection