@extends('themes::default.layout')

@push('head')
    <style>
        .bg-home {
            background-image: url("{{ asset('modules/themes/default/images/home_slider.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            position: relative;
            padding: 0px 0px 0px 0px;
        }
    </style>
@endpush
@section('content')
    @include('themes::default.nav')
    <!-- END HOME -->
    <section class="bg-home" id="home">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="home-content">
                                <h1 class="home-title">@lang('Find a job with') {{ config('app.name') }}</h1>

                                <p class="text-primary mt-3 f-20">@lang('OWN A GOOD Resume-CV AND DREAM JOB')</p>
                                <p>@lang('10,000+ job opportunities are successfully connected every day')</p>
                                <div class="mt-3">
                                    <a href="{{ route('templates') }}" class="btn btn-primary">@lang('Create Resume Online')</a>
                                    <a href="{{ route('jobslist') }}" class="btn btn-primary">@lang('Find Jobs')</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <div class="mt-2">
                                <h5><a href="/shortcuts" class="text-decoration-none">Shortcuts</a></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href="/services">Services</a></li>
                                    <li class="list-group-item"><a href="/portfolio">Portfolio</a></li>
                                    <li class="list-group-item"><a href="/blog">Blog</a></li>
                                </ul>
                                {{-- <img src="{{ asset('img/undraw_interview_rmcf.png') }}" width="400" class="img-fluid"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <form id="form_search_home_page" action="javascript:void(0);">
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <input class="form-control" value="" placeholder="@lang('Job title, position you want to apply for')"
                                            id="keyword" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="city" tabindex="-1" aria-hidden="true">
                                            <option value="">@lang('All location')</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="category" tabindex="-1" aria-hidden="true">
                                            <option value="">@lang('All Functional Area')</option>
                                            @foreach ($functional_areas as $functional_area)
                                                <option value="{{ $functional_area->id }}">{{ $functional_area->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group col-button">
                                        <button class="btn btn-primary"><i class="pe-7s-search"></i>
                                            @lang('Find job')</button>
                                    </div>

                                </div>
                        </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </section>
    @if (config('app.ads_home_page_below_jobs_search'))
        <section class="mb-4">
            <div class="container">
                <div class="row">
                    <div class="ads-home-page">
                        {!! config('app.ads_home_page_below_jobs_search') !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- END HOME -->

    @isset($companies)

        <!-- START Featured Companies -->
        <section class="section pt-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h2 class="mb-0">@lang('Featured Companies')</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($companies as $company)
                        <div class="col-md-4">
                            @include('themes::default.includes.item_featured_company', [
                                'company' => $company,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END Featured Companies -->
    @endisset
    <!-- START Featured Jobs -->
    <section class="section pt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="mb-0">@lang('Featured Jobs')</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">

                        @foreach ($featuredJobs as $job)
                            <div class="col-md-6">
                                @include('themes::default.includes.item_job_side', ['job' => $job])
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>

            <div class="btn-homepage-center"><a href="{{ route('jobslist', ['featured' => '1']) }}"
                    class="btn btn-primary">@lang('View All Featured Jobs')</a></div>
        </div>
    </section>
    <!-- END Featured Jobs -->

    <!-- START HOW IT WORK -->
    <section class="section pt-5 bg-light" id="how-it-work">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="mb-0">@lang('How Create Resume-CV Online')</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="arrow">
                            <img src="{{ Module::asset('themes:default/images/arrow-1.png') }}" alt="">
                        </div>
                        <div class="work-count">
                            <p class="mb-0">1</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-file"></i>
                        </div>
                        <h5 class="mt-4">@lang('Select a template')</h5>
                        <p class="text-muted mt-3">
                            @lang('Choose from a selection of recruiter-approved layout designs for different job types')
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="arrow">
                            <img src="{{ Module::asset('themes:default/images/arrow-2.png') }}" alt="">
                        </div>
                        <div class="work-count">
                            <p class="mb-0">2</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-pen"></i>
                        </div>
                        <h5 class="mt-4">@lang('Optimize Your Content')</h5>
                        <p class="text-muted mt-3">
                            @lang('And adding or removing a specific section based on your needs is no problem and you get layout and content suggestions so that your resume looks perfect')
                        </p>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="work-count">
                            <p class="mb-0">3</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-user"></i>
                        </div>
                        <h5 class="mt-4">@lang('Publish or Download PDF')</h5>
                        <p class="text-muted mt-3">
                            @lang('Once your content is finished, you can publish link or dowwnload PDF. Your latest version is saved and you can always go back to make edits.')
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- END HOW IT WORK -->
    <!-- START Latest Jobs -->
    <section class="section pt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="mb-0">@lang('Latest Jobs')</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($lastestJobs as $job)
                            <div class="col-md-6">
                                @include('themes::default.includes.item_job_side', ['job' => $job])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="btn-homepage-center"><a href="{{ route('jobslist', ['lastest' => '1']) }}"
                    class="btn btn-primary">@lang('View All Latest Jobs')</a></div>
        </div>
    </section>
    <!-- END Latest Jobs -->
    <!-- START WHY -->
    <section class="section bg-light" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box text-center">
                        <h2 class="mb-0">@lang('Why Should Use') {{ config('app.name') }}?</h2>
                    </div>
                </div>
            </div>


            <div class="row align-items-center mt-5">

                <div class="col-lg-6">
                    <div class="nav flex-column nav-pills mt-4">
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-search"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Search Job')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-note2"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">
                                            @lang('Apply a Job')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor.')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-check"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Job Security')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>



                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav flex-column nav-pills mt-4">
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-note2"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 f-18 services-title mt-2">@lang('Create Resume or CV')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-paper-plane"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 f-18 services-title mt-2">@lang('Easy Publish Resume or CV')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-call"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Happy Support')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END WHY -->



@stop

@push('scripts')
    <script type="text/javascript">
        var url_search_home_page = "{{ route('jobslist', ['q' => ':q']) }}";
    </script>
@endpush
