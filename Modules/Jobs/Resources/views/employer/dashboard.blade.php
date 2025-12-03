@extends('core::layouts.app')
@section('title', __('Dashboard'))
@section('content')
{{-- Example Dashboard --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Company Dashboard')</h1>
</div>
<div class="row">
    <div class="col-md-4">
        <a href="{{route('company.jobs.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">
                                @lang('Total Jobs')
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-600">{{$total_jobs}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{route('company.jobs.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">@lang('Total Jobs Featured')
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-600">{{$total_jobs_featured}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
</div>
@if(Module::find('Saas'))
<div class="mt-4 mb-4">
     <h1 class="h3 text-gray-800">@lang('Subscription')</h1>
    @if(!$subscribed)
     <div class="alert alert-warning">
        @lang('Upgrade your account. To get more applicants.')
    </div>
    @endif
     
</div>


@if(!$subscribed)
<div class="row">
    <div class="col-md-{{ 12 / (count($packages) + 1)}}">
        <div class="package-item">
            <div class="item">
                <div class="header-package">
                    <div class="inner-package">
                        <div class="top-package-info clearfix flex-middle-lg">
                            <h3 class="title">@lang('Package Free')</h3>
                        </div>
                    </div>
                </div>
                <div class="bottom-package">
                    <div class="price">
                        <span class="">@lang('Free')</span>
                    </div>
                    <span class="f-16 text-muted">@lang('Free')</span>
                    <div class="package-des">
                        <ul>
                            @if(config('saas.no_job_post') == -1)
                                <li><i class="fas fa-check"></i>@lang('Unlimited Job posting')</li>
                            @else
                                <li><i class="fas fa-check"></i>@lang(':number Job posting',['number' => config('saas.no_job_post')])</li>
                            @endif
                            @if(config('saas.no_job_featured') == -1)
                                <li><i class="fas fa-check"></i>@lang('Unlimited Job featured')</li>
                            @else
                                <li><i class="fas fa-check"></i>@lang(':number Job featured',['number' => config('saas.no_job_featured')])</li>
                            @endif
                            <li><i class="fas @if(config('saas.featured_company') && config('saas.featured_company') == true) fa-check @else fa-times @endif"></i>@lang('Featured Company')</li>
                            <li><i class="fas @if(config('saas.support_24_7') && config('saas.support_24_7') == true) fa-check @else fa-times @endif"></i>@lang('Premium Support 24/7')</li>
                        </ul>
                    </div>
                    <div class="button-action">
                        <div class="add-cart">
                            <button class="button btn-block" disabled="">
                                @lang('Free') </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($packages as $package)
        <div class="col-md-{{ 12 / (count($packages) + 1)}}">
            <div class="package-item @if($package->is_featured == 1) is_featured @endif ">
                <div class="item">
                    <div class="header-package">
                        <div class="inner-package">
                            <div class="top-package-info clearfix flex-middle-lg">
                                <h3 class="title">{{ $package->title }}</h3>
                                @if($package->is_featured == 1)
                                    <div class="recommended align-right">
                                    @lang('Recommended')</div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="bottom-package">
                        <div class="price">
                            <span class="">{{ $currency_symbol }}</span>{{ $package->price }}

                        </div>
                        <span class="f-16 text-muted">{{$package->interval_number}} @lang($package->interval)</span>
                        <div class="package-des">
                            <ul>
                                @if($package->settings['no_job_post'] == -1)
                                <li><i class="fas fa-check"></i>@lang('Unlimited Job posting')</li>
                                @else
                                    <li><i class="fas fa-check"></i>@lang(':number Job posting',['number' => $package->settings['no_job_post']])</li>
                                @endif
                                @if($package->settings['no_job_featured']== -1)
                                    <li><i class="fas fa-check"></i>@lang('Unlimited Job featured')</li>
                                @else
                                    <li><i class="fas fa-check"></i>@lang(':number Job featured',['number' => $package->settings['no_job_featured']])</li>
                                @endif
                                
                                <li><i class="fas @if($package->hasPermissionTo('featured_company') && $package->settings['featured_company'] == true) fa-check @else fa-times @endif"></i>@lang('Featured Company')</li>
                                <li><i class="fas @if($package->hasPermissionTo('support_24_7') && $package->settings['support_24_7'] == true) fa-check @else fa-times @endif"></i>@lang('Premium Support 24/7')</li>
                            </ul>
                        </div>
                        <div class="button-action">
                            <a href="{{ route('billing.package', $package) }}" class="button btn-block">@lang('Upgrade Now')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif


@if($subscribed)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
           @lang('Your subscription for <strong>:package</strong> package is currently active and expires in <strong>:expires_in</strong> days!', ['package' => $subscription_title, 'expires_in' => $subscription_expires_in])
        </div>
   
    </div>
</div>
@endif
@if($subscribed)
<div class="row">
    <div class="col-md-12">
    
        <div class="text-right">
            <form action="{{ route('billing.cancel') }}" method="POST" onsubmit="return confirm('@lang('Confirm cancel subscription?')');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-secondary btn-clean">
                    <i class="fe fe-x-circle"></i> @lang('Cancel subscription') &ndash; {{ $subscription_title }}
                </button>
            </form>
        </div>
    </div>
</div>
@endif
@endif
{{-- End Company Dashboard --}}

@stop