@extends('admin.layouts.login_layout')
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            
                        </span>
                        <span class="app-brand-text demo text-body fw-bold">{{ config('app.name') }}</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Reset Password 🔒</h4>
                <p class="mb-4">Please Enter New Password</p>
                <form method="POST" action="{{ route('company.reset.password.post') }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$email}}">
                    @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                    <div class="form-group position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        <span class="position-absolute" style="top: 38px; right: 15px; cursor: pointer; z-index: 2;" onclick="togglePassword('password', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group mb-3 position-relative">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                        <span class="position-absolute" style="top: 38px; right: 15px; cursor: pointer; z-index: 2;" onclick="togglePassword('password-confirm', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Reset Password') }}</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{route('company.login')}}" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div> 
@endsection



@section('script')
<script>
window.togglePassword = function(fieldId, el) {
    var input = document.getElementById(fieldId);
    var icon = el.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
    } else {
        input.type = 'password';
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
    }
}
</script>
@endsection

