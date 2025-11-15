@extends('themes::default.layout')
@section('content')
@include('themes::default.nav')
<section class="pt-4 pb-4">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h3><strong>@lang('Discover now all best jobs on') {{ config('app.name')}}</strong></h3>
                            </div>
                        </div>
                        <form id="form_search" action="javascript:void(0);">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input class="form-control" value="{{ $q }}" placeholder="@lang('Job title, position you want to apply for')" id="keyword" autocomplete="off">
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="city" tabindex="-1" aria-hidden="true">
                                        <option value="">@lang('All location')</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ $filter_city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="category" tabindex="-1" aria-hidden="true">
                                        <option value="">@lang('All Functional Area')</option>
                                        @foreach($functional_areas as $functional_area)
                                        <option value="{{ $functional_area->id }}" {{ $filter_functional_area_id == $functional_area->id ? 'selected' : '' }}>{{ $functional_area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-block"><i class="pe-7s-search"></i> @lang('Find job')</button>
                                </div>
                            </div>
                            <div id="form-search-advanced" class="mt-2">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <input class="form-control" type="number" id="salary_from" value="{{ $filter_salary_from }}" placeholder="@lang('Salary from')">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input class="form-control" type="number" id="salary_to" value="{{ $filter_salary_to }}" placeholder="@lang('Salary to')">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control"  tabindex="-1" aria-hidden="true" id="job_type">
                                            <option value="">@lang('All Job Type')</option>
                                            @foreach($job_types as $job_type)
                                            <option value="{{ $job_type->id }}" {{ $filter_job_type_id == $job_type->id ? 'selected' : '' }}>{{ $job_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>     
                            <div class="row">
                                <div class="col-md-9">&nbsp;</div>
                                <div class="col-md-3">
                                    <div class="pull-right" id="show_advanced">
                                        <a href="#" id="btn-show-advanced-search">
                                            <i class="pe-7s-angle-down"></i>@lang('Search advanced')
                                        </a>
                                        <a href="#" id="btn-hidden-advanced-search">
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
                            <div class="col-md-12">
                                @foreach($data as $item)
                                    @include('themes::default.includes.item_job_side', ['job' => $item])
                                @endforeach
                            </div>
                        </div>
                        <div class="row justify-content-end my-5">
                            <div class="col-auto">
                                {{ $data->appends( Request::all() )->links() }}
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
    var url_search_jobs = "{{ route('jobslist', ['q' => ':q']) }}";
</script>
@endpush