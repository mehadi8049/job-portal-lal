@extends('themes::default.layout')


@push('head')
    <style>
        a {
            text-decoration: none !important;
        }

        .bd-search-box {
            background: #ed7724cf;
            padding: 15px;
            margin-bottom: 1rem !important;
            border-radius: 4px;

        }

        h3 {

            color: #ffffff;

        }

        .form-group {
            margin-bottom: 0px !important;
        }
    </style>
@endpush


@section('content')
    <section class="pb-4">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h3><strong>@lang('Discover now all best jobs')</strong></h3>
                                </div>
                            </div>
                            <form id="form_search" action="javascript:void(0)" method="GET">
                                <div class="row bd-search-box">
                                    <div class="form-group col-md-4">
                                        <input class="form-control" value="{{ request()->keyword }}" name="keyword"
                                            type="text" placeholder="@lang('Job title, position you want to apply for')" id="keyword"
                                            autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="organization_type" name="organization_type"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="">@lang('Organization Type')</option>
                                            @foreach ($organization_types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $type->id == request()->organization_type ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="city" name="city" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="">@lang('All location')</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ $filter_city_id == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block"><i class="pe-7s-search"></i>
                                            @lang('Find job')</button>
                                    </div>
                                </div>
                                <div id="form-search-advanced" class="mt-2">
                                    <div class="row">

                                        <div class="form-group col-md-3">
                                            <select class="form-control" name="functionalarea" id="functionalarea"
                                                tabindex="-1" aria-hidden="true">
                                                <option value="">@lang('All Functional Area')</option>
                                                @foreach ($functional_areas as $functional_area)
                                                    <option value="{{ $functional_area->id }}"
                                                        {{ $functional_area->id == request()->functionalarea ? 'selected' : '' }}>
                                                        {{ $functional_area->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control" tabindex="-1" aria-hidden="true" id="job_type"
                                                name="job_type">
                                                <option value="">@lang('All Job Type')</option>
                                                @foreach ($job_types as $job_type)
                                                    <option value="{{ $job_type->id }}"
                                                        {{ $filter_job_type_id == $job_type->id ? 'selected' : '' }}>
                                                        {{ $job_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input class="form-control" type="number" id="salary_from" name="salary_from"
                                                value="{{ $filter_salary_from }}" placeholder="@lang('Salary from')">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input class="form-control" type="number" id="salary_to" name="salary_to"
                                                value="{{ $filter_salary_to }}" placeholder="@lang('Salary to')">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-9">&nbsp;</div>
                                    <div class="col-md-3">
                                        <div class="pull-right " id="show_advanced">
                                            <a href="#" class="text-white" id="btn-show-advanced-search">
                                                <i class="pe-7s-angle-down"></i>@lang('Search advanced')
                                            </a>
                                            <a href="#" class="text-white" id="btn-hidden-advanced-search">
                                                <i class="pe-7s-angle-up"></i>@lang('Hide search advanced')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5><strong>@lang('We found :num Matches for you', ['num' => $data->total()])</strong></h5>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($data as $item)
                                    <div class="col-lg-6 col-md-6 mb-3">
                                        @include('themes::default.includes.item_job_side', [
                                            'job' => $item,
                                        ])
                                    </div>
                                @endforeach
                            </div>

                            <div class="row justify-content-end my-5">
                                <div class="col-auto">
                                    {{ $data->appends(Request::all())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')
    <script type="text/javascript">
        var url_search_jobs = "{{ route('jobslist') }}";
    </script>
@endpush
