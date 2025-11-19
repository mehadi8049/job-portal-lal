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
    @if(!Route::is('login'))
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

    <!-- START COUNTER -->
    <section class="section pt-5">
        <div class="container">
            <div class="row" id="counter">
                <div class="col-lg-5">
                    <div class="counter-info mt-4">
                        <h3>@lang('Trusted by 10,000+ employer')</h3>
                        <p class="text-muted mt-4">@lang('Discover why more than 10,000 employer choose') {{ __(config('app.name')) }}.</p>
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">@lang('Login Now') <i
                                    class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-emoticon-outline text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value"
                                                data-count="10000">0</span>
                                            +</h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Employer')</h5>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-flag text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value" data-count="24">0</span>
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Languages')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="pe-7s-note2 text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value"
                                                data-count="20000">0</span> +
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Jobs')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-timer text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value" data-count="5">0</span> +
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Years of expe'). </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COUNTER -->
    <!-- START FOOTER -->
    <section class="py-4 footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5 col-sm-6">
                    <p class="mb-0 f_400">@lang('Copyright') © {{ now()->year }} @lang('Design by') <a
                            href="https://codexaa.com">Codexaa Limited</a></p>
                </div>

                <div class="col-lg-6 col-md-4 col-sm-12">
                    <ul class="list-unstyled f_menu text-right">
                        {!! menuBottomSkins(['pagewebsites' => $pagewebsites]) !!}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- END FOOTER -->
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
