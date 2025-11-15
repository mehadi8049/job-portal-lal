@extends('core::layouts.app')
@section('title', __('Dashboard'))
@section('content')
{{-- Example Dashboard --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Admin Dashboard')</h1>
</div>
<div class="row">
    <div class="col-md-3">
        <a href="{{route('settings.companies.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body bg-primary text-light">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold mb-1">
                                @lang('Total Company')
                            </div> 
                            <div class="h5 mb-0 font-weight-bold">{{$total_companies}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('settings.jobs.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body bg-info text-light">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold mb-1">
                                @lang('Total Jobs')
                            </div> 
                            <div class="h5 mb-0 font-weight-bold">{{$total_jobs}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('settings.users.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body bg-dark text-light">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold mb-1">
                                @lang('Total Employers')
                            </div> 
                            <div class="h5 mb-0 font-weight-bold">{{$total_employers}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('settings.users.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body bg-success text-light">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold mb-1">
                                @lang('Total Candidates')
                            </div> 
                            <div class="h5 mb-0 font-weight-bold">{{$total_candidates}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tag fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
          <div class="card-header text-uppercase font-weight-bold text-gray-800">
            @lang('Recent register companies')
          </div>
          <div class="card-body">
            <ul class="list-group">
                @foreach($recent_20_companies as $item)
                <li class="list-group-item">
                    <i class="fas fa-building text-dark"></i>
                    <a href="{{route('settings.companies.edit',$item)}}" class="text-dark">{{$item->company_name}} ({{$item->company_email}}) @if(isset($item->city)), <i class="fas fa-map-marker"></i> {{$item->city->name}} @endif</a>
                </li>
                @endforeach
            </ul>
          </div>
          <div class="card-footer text-right">
            <a href="{{route('settings.companies.index')}}" class="text-dark">@lang('See all companies') <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
          <div class="card-header text-uppercase font-weight-bold text-gray-800">
            @lang('Recent jobs')
          </div>
          <div class="card-body">
            <ul class="list-group">
                @foreach($recent_20_jobs as $item)
                <li class="list-group-item">
                    <i class="fas fa-briefcase text-dark"></i>
                    <a href="{{route('settings.jobs.edit',$item)}}" class="text-dark">{{$item->title}} ({{$item->company->company_name}}) @if(isset($item->city)), <i class="fas fa-map-marker"></i> {{$item->city->name}} @endif</a>
                </li>
                @endforeach
            </ul>
          </div>
          <div class="card-footer text-right">
            <a href="{{route('settings.jobs.index')}}" class="text-dark">@lang('See all jobs') <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
    </div>
</div>


{{-- End Admin Dashboard --}}

@stop