@extends('themes::default.layout')
@section('content')
@include('themes::default.nav')
<div class="employer-header bg-light">
    <div class="container">
        <div class="clearfix">
            <div class="flex-middle-sm row">
            <div class="company-img">
                <a href="javascript:void(0);">
                    <img width="100" height="100" src="{{ $company->getLogoLink() }}">
                </a>
            </div>
            <div class="employer-info-detail">
                <div class="title-wrapper">
                    <h1 class="employer-title">{{$company->company_name}}</h1>
                </div>
                <div class="employer-metas">
                    @isset($company->industry)
                    <div class="category-job">
                        <div class="employer-category with-icon">
                            <i class="pe-7s-id"></i>
                            <a href="{{ route('companies', ['industry' => $company->industry->id]) }}" style="">{{$company->industry->name}}</a>
                        </div>
                    </div>
                    @endisset
                    @isset($company->city)
                    <div class="employer-location">
                        <i class="pe-7s-map-marker"></i>
                        <a href="{{ route('companies', ['city' => $company->city->id]) }}">{{$company->city->name}}</a>
                    </div>
                    @endisset
                    @isset($company->phone)
                    <div class="employer-deadline"><i class="pe-7s-headphones"></i> {{$company->phone}}</div>
                    @endisset
                    @isset($company->company_email)
                    <div class="employer-salary"><i class="pe-7s-mail"></i> {{$company->company_email}}</div>
                    @endisset
                </div>

                <div class="employer-metas-bottom">
                    <div class="employer-type title-box">
                        <h6 class="title-sub-title mb-0 text-primary">@lang('Open Jobs') - <span>{{ $company->jobs()->active()->count() }}</span></h6>
                        @if ($company->is_featured)
                            <h6 class="title-sub-title job-featured">@lang('Featured')</h6>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="employer-content container">
    <div class="row pt-5">
        <div class="col-xs-12 col-md-8 list-content-candidate">
            <div class="employer-detail-description">
                <h3 class="title">@lang('About Company')</h3>
                <div class="inner">
                    {!! $company->description !!}
                </div>
            </div>
            <div class="social-job-detail">
                <span class="title">@lang('Social Profiles'): </span>
                @isset($company->facebook)
                <a href="{{$company->facebook}}"><i class="mdi mdi-facebook"></i></a>
                @endisset
                @isset($company->twitter)
                <a href="{{$company->twitter}}"><i class="mdi mdi-twitter"></i></a>
                @endisset
                @isset($company->linkedin)
                <a href="{{$company->linkedin}}"><i class="mdi mdi-linkedin"></i></a>
                @endisset
                @isset($company->youtube)
                <a href="{{$company->youtube}}"><i class="mdi mdi-youtube"></i></a>
                @endisset
                @isset($company->instagram)
                <a href="{{$company->instagram}}"><i class="mdi mdi-instagram"></i></a>
                @endisset
            </div>
            <div class="employer-detail-description">
                <h3 class="title">@lang('Open Position')</h3>
                <div class="row">
                    <div class="col-md-12">
                        @php 
                            $jobs = $company->jobs()->active()->orderBy('is_featured', 'desc')->get();
                        @endphp
                        @foreach($jobs as $job)
                            @isset($job)
                                @include('themes::default.includes.item_job_side', ['job' => $job])
                            @endisset($job)
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4 col-xs-12 sidebar-job">
            <aside class="widget widget_apus_employer_info">
                <div class="job-detail-employer-info">
                    <div class="job-category">
                        <h3 class="title">@lang('Categories'):</h3>
                        <div class="value">
                            @isset($company->industry)
                            <a class="category-employer" href="{{ route('companies', ['industry' => $company->industry->id]) }}">{{$company->industry->name}}</a>
                            @endisset
                        </div>
                    </div>
                    <div class="employer-meta with-icon-title">
                        <h3 class="title">
                            @lang('Founded Date')
                        </h3>
                        <div class="value">
                            {{$company->established_in}} 
                        </div>
                    </div>
                    <div class="employer-meta with-icon-title">
                        <h3 class="title">
                            @lang('Company Size'):
                            
                        </h3>
                        <div class="value">
                            {{$company->no_of_employees}} 
                        </div>
                    </div>
                    <div class="employer-meta with-icon-title">
                        <h3 class="title">
                            @lang('Offices Size'):
                            
                        </h3>
                        <div class="value">
                            {{$company->no_of_offices}} 
                        </div>
                    </div>
                    @isset($company->location)
                    <div class="employer-location">
                        <h3 class="title">@lang('Address'):</h3>
                        <div class="value">
                            <a href="javascript:void(0);">{{$company->location}}</a>
                        </div>
                    </div>
                    @endisset
                    @isset($company->phone)
                    <div class="job-phone">
                        <h3 class="title">@lang('Phone Number'):</h3>
                        <div class="value">
                            <div class="phone-wrapper phone-hide">
                                <a class="phone" href="tel:{{$company->phone}}">{{$company->phone}}</a>
                            </div>
                        </div>
                    </div>
                    @endisset
                    @isset($company->email)
                    <div class="job-email">
                        <h3 class="title">@lang('Email'):</h3>
                        <div class="value">
                            {{$company->email}} </div>
                    </div>
                    @endisset
                    <div class="social-employer">
                        <h3 class="title">@lang('Socials')</h3>
                        <div class="value">
                            <div class="apus-social-share">
                                @isset($company->facebook)
                                <a href="{{$company->facebook}}"><i class="mdi mdi-facebook"></i></a>
                                @endisset
                                @isset($company->twitter)
                                <a href="{{$company->twitter}}"><i class="mdi mdi-twitter"></i></a>
                                @endisset
                                @isset($company->linkedin)
                                <a href="{{$company->linkedin}}"><i class="mdi mdi-linkedin"></i></a>
                                @endisset
                                @isset($company->youtube)
                                <a href="{{$company->youtube}}"><i class="mdi mdi-youtube"></i></a>
                                @endisset
                                @isset($company->instagram)
                                <a href="{{$company->instagram}}"><i class="mdi mdi-instagram"></i></a>
                                @endisset
                            </div>
                        </div>
                    </div>
                    @isset($company->website)
                    <div class="employer-website">
                        <a href="{{$company->website}}" class="btn btn-info btn-block">{{ getDomainFromURL($company->website) }}</a>
                    </div>
                    @endisset
                </div>
            </aside>
            @isset($company->location)
            <aside class="widget widget_apus_employer_maps">
                <h2 class="widget-title"><span>@lang('Employer Location')</span></h2>
                <div>
                    <iframe src="https://maps.google.it/maps?q={{urlencode(strip_tags($company->location))}}&output=embed" allowfullscreen frameBorder="0"></iframe>
                </div>
            </aside>
            @endisset
        </div>
    </div>
</div>
@stop
