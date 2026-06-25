<!-- Preloader -->
<div class="preloader style3" style="opacity: 0; display: none">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- /End Preloader -->

<!-- Start Header Area -->
<header class="header style3">
    <div class="navbar-area sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <!-- Logo -->
                        <a class="navbar-brand logo" href="{{ route('home') }}">
                            <!-- White Logo -->
                            <img class="primary-logo"
                                src="{{ asset('assets/web/assets/images/logo/precure-skill3-white.png') }}"
                                alt="Logo">

                            <!-- Dark Logo -->
                            <img class="alt-logo"
                                src="{{ asset('assets/web/assets/images/logo/precure-skill3.png') }}"
                                alt="Logo">
                        </a>

                        <!-- Toggle Button -->
                        <button class="navbar-toggler" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <!-- Menu -->
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about.us') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('service') }}">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('plan') }}">Plans</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Menu -->

                        <!-- Login Dropdown Button -->
                        <div class="button">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Get Started
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.login') }}">
                                            👤 User Login
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('company.login') }}">
                                            🏢 Company Login
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Button -->

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header Area -->