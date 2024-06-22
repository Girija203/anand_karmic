<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
    @include('Admin.theme_css')
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


    <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body class="authentication-bg position-relative">
    <div class="container">
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-lg-10">
                        <div class="card overflow-hidden bg-white shadow-sm border-0">
                            <div class="row g-0">
                                <div class="col-lg-6 d-none d-lg-block p-2">
                                    <img src="{{ asset('assets/admin/images/auth-img.png') }}" alt=""
                                        class="img-fluid rounded h-100">
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column h-100">
                                        <div class="auth-brand p-4">
                                            {{-- <a href="index.html" class="logo-light">
                                                 <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo"
                                                     height="48">
                                             </a> --}}
                                            <a href="index.html" class="logo-dark">
                                                <img src="{{ asset('assets/admin/images/logo-dark.png') }}"
                                                    alt="dark logo" height="48">
                                            </a>
                                        </div>
                                        <div class="p-4 my-auto">
                                            <h4 class="fs-20">Sign In</h4>
                                            <p class="text-muted mb-3">Enter your email address and password to access
                                                account.
                                            </p>

                                            <!-- form -->
                                            <form method="POST" action="{{ route('adminlogin.validate') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email"
                                                        class="form-label">{{ __('Email Address') }}</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                        type="email" id="email" placeholder="Enter your email" name="email"
                                                        required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <!-- <a href=""
                                                        class="text-muted float-end"><small>
                                                            {{ __('Forgot Your Password?') }}</small></a> -->
                                                    <label for="password"
                                                        class="form-label">{{ __('Password') }}</label>
                                                    <div class="input-group">
                                                        <input
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            type="password" id="password" name="password"
                                                            placeholder="Enter your password" required>
                                                        <button type="button" class="btn"
                                                            style="border:var(--tz-border-width) solid var(--tz-border-color)"
                                                            id="togglePassword">
                                                            <i id="togglePasswordIcon" class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-0 text-start">
                                                    <button class="btn btn-soft-primary w-100" type="submit"><i
                                                            class="ri-login-circle-fill me-1"></i> <span
                                                            class="fw-bold">Log
                                                            In</span> </button>
                                                </div>

                                                <!-- <div class="text-center mt-4">
                                                    <p class="text-muted fs-16">Sign in with</p>
                                                    <div class="d-flex gap-2 justify-content-center mt-3">
                                                        <a href="javascript: void(0);" class="btn btn-soft-primary"><i
                                                                class="ri-facebook-circle-fill"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-soft-danger"><i
                                                                class="ri-google-fill"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-soft-info"><i
                                                                class="ri-twitter-fill"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-soft-dark"><i
                                                                class="ri-github-fill"></i></a>
                                                    </div>
                                                </div> -->
                                            </form>
                                            <!-- end form-->

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <div class="row">
                    <!-- <div class="col-12 text-center">
                        <p class="text-dark-emphasis">Don't have an account? <a href="auth-register.html"
                                class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign
                                    up</b></a>
                        </p>
                    </div>  -->
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const togglePasswordIcon = document.querySelector('#togglePasswordIcon');

        togglePassword.addEventListener('click', function(e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye slash icon
            if (type === 'password') {
                togglePasswordIcon.classList.remove('bi-eye-slash');
                togglePasswordIcon.classList.add('bi-eye');
            } else {
                togglePasswordIcon.classList.remove('bi-eye');
                togglePasswordIcon.classList.add('bi-eye-slash');
            }
        });
    });
</script>

</html>
