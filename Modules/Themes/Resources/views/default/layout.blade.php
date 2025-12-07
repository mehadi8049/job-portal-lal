<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @includeWhen(config('app.GOOGLE_ANALYTICS'), 'core::partials.google-analytics')
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ __(config('app.name')) }} &mdash; {{ config('app.SITE_SLOGAN') }}</title>
        <meta name="description" content="{{ config('app.SITE_DESCRIPTION') }}">
        <meta name="keywords" content="{{ config('app.SITE_KEYWORDS') }}">
        <link rel="shortcut icon" href="{{ asset(config('app.logo_favicon')) }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700&display=swap">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css"
            href="{{ Module::asset('themes:default/css/materialdesignicons.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/fonts/icomoon/style.css') }}" />
        <link rel="stylesheet" type="text/css"
            href="{{ Module::asset('themes:default/owlcarousel2/assets/owl.carousel.min.css') }}" />
        <link rel="stylesheet" type="text/css"
            href="{{ Module::asset('themes:default/owlcarousel2/assets/owl.theme.default.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/style.css') }}" />

        @stack('head')


        <style>
            /* --- Section Background --- */
            .section-counter-awesome {
                background-color: #083344;
                padding: 80px 0;
                overflow: hidden;
                /* Prevents overflow scrolling */
            }

            /* --- Text Side (Left) --- */
            .counter-content h3 {
                color: #ffffff;
                font-weight: 800;
                font-size: 36px;
                margin-bottom: 20px;
            }

            .counter-content p {
                color: rgba(255, 255, 255, 0.9);
                font-size: 18px;
                margin-bottom: 35px;
                max-width: 450px;
                /* Ensures text doesn't stretch too wide */
            }

            /* --- Stats Grid (The Fix) --- */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                /* 2 Columns */
                gap: 30px;
                /* Consistent spacing vertically and horizontally */
            }

            /* --- Card Styling --- */
            .stat-card {
                background: #ffffff;
                padding: 30px 25px;
                border-radius: 20px;
                /* Softer rounded corners */
                display: flex;
                align-items: center;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                transition: transform 0.3s ease;
                height: 100%;
                /* Ensures all cards match height */
            }

            .stat-card:hover {
                transform: translateY(-5px);
            }

            .stat-icon-box {
                width: 55px;
                height: 55px;
                background-color: #eef2fa;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 20px;
                flex-shrink: 0;
            }

            .stat-icon-box i {
                color: #3360ad;
                font-size: 28px;
            }

            .stat-details h3 {
                color: #2c3e50;
                font-size: 26px;
                font-weight: 800;
                margin: 0;
                line-height: 1.1;
            }

            .stat-details h5 {
                color: #8898aa;
                font-size: 13px;
                text-transform: uppercase;
                font-weight: 700;
                margin-top: 5px;
                margin-bottom: 0;
                letter-spacing: 0.8px;
            }

            /* --- Custom Button --- */
            .btn-awesome-white {
                background-color: #ed7724;
                color: #ffffff;
                font-weight: 700;
                padding: 14px 35px;
                border-radius: 50px;
                text-transform: uppercase;
                letter-spacing: 1px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;

            }

            .btn-awesome-white:hover {
                background-color: #cf681e;
                color: #ffffff;

                text-decoration: none;
            }

            .btn-awesome-white i {
                margin-left: 8px;
            }

            /* --- Mobile Responsive Fix --- */
            @media (max-width: 768px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                    /* Stack cards on mobile */
                    gap: 20px;
                    margin-top: 40px;
                }
            }

            /* --- Awesome Footer Styles --- */
            .footer-awesome {
                background-color: #ffffff;
                border-top: 1px solid #eaeaea;
                padding: 20px 0;
            }

            .footer-text {
                color: #6c757d;
                font-size: 14px;
                margin: 0;
            }

            .footer-text a {
                color: #3360ad;
                font-weight: 700;
                text-decoration: none;
                transition: color 0.2s;
            }

            .footer-text a:hover {
                color: #1a3a6e;
                text-decoration: underline;
            }

            .footer-menu {
                margin: 0;
                padding: 0;
                list-style: none;
                text-align: right;
            }

            /* Adjust for mobile responsiveness */
            @media (max-width: 768px) {
                .footer-menu {
                    text-align: center;
                    /* Center on mobile */
                    margin-top: 15px;
                }

                .footer-text {
                    text-align: center;
                }
            }
        </style>
    </head>

    <body data-spy="scroll" data-target="#navbarCollapse">
        @if (session('success'))
            <div class="alert alert-success border-radius-none">
                <i class="fas fa-check-circle text-success mr-2"></i> {!! session('success') !!}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger border-radius-none">
                <i class="fas fa-times text-danger mr-2"></i> {!! session('error') !!}
            </div>
        @endif
        @if (
            !Route::is('login') &&
                !Route::is('register') &&
                !Route::is('password.request') &&
                !Route::is('password.reset') &&
                !Route::is('login.social') &&
                !Route::is('login.callback'))
            @include('themes::default.ads')
            @include('themes::default.nav')
        @endif
        @yield('content')
        @if (config('app.ads_footer_layout_themes'))
            <section class="mb-4">
                <div class="container">
                    <div class="row">
                        <div class="ads-home-page">
                            {!! config('app.ads_footer_layout_themes') !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="section-counter-awesome">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="counter-content">
                            <h3>@lang('Trusted by 10,000+ employer')</h3>
                            <p>@lang('Discover why more than 10,000 employer choose') {{ __(config('app.name')) }}. We connect talent with opportunity
                                seamlessly.</p>
                            <div>
                                <a href="{{ route('login') }}" class="btn-awesome-white">
                                    @lang('Login Now') <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon-box">
                                    <i class="mdi mdi-emoticon-outline"></i>
                                </div>
                                <div class="stat-details">
                                    <h3><span class="counter-value" data-count="10000">0</span>+</h3>
                                    <h5>@lang('Employer')</h5>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon-box">
                                    <i class="mdi mdi-flag"></i>
                                </div>
                                <div class="stat-details">
                                    <h3><span class="counter-value" data-count="24">0</span></h3>
                                    <h5>@lang('Languages')</h5>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon-box">
                                    <i class="pe-7s-note2" style="font-weight: bold;"></i>
                                </div>
                                <div class="stat-details">
                                    <h3><span class="counter-value" data-count="20000">0</span>+</h3>
                                    <h5>@lang('Jobs')</h5>
                                </div>
                            </div>

                            <div class="stat-card">
                                <div class="stat-icon-box">
                                    <i class="mdi mdi-timer"></i>
                                </div>
                                <div class="stat-details">
                                    <h3><span class="counter-value" data-count="5">0</span>+</h3>
                                    <h5>@lang('Years Exp.')</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="footer-awesome">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <p class="footer-text">
                            @lang('Copyright') © {{ now()->year }}
                            @lang('Design by') <a href="https://codexaa.com" target="_blank">Codexaa Limited</a>
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <ul class="footer-menu">
                            {!! menuBottomSkins(['pagewebsites' => $pagewebsites]) !!}
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- ----------------- --}}
        <script src="{{ Module::asset('themes:default/js/jquery.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/owlcarousel2/owl.carousel.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/jquery.easing.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/jquery.mb.YTPlayer.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/contact.init.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/counter.init.js') }}"></script>
        @stack('scripts')
        <script src="{{ Module::asset('themes:default/js/app.js') }}"></script>

    </body>

</html>
