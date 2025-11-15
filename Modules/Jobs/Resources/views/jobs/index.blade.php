@extends('core::layouts.app')
@section('title', __('All Jobs'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-4 text-gray-800">@lang('All Jobs')</h1>
        <div class="ml-auto d-sm-flex">
          <form method="get" action="" class="navbar-search mr-4">
              <div class="input-group">
                  <input type="text" name="search" value="{{ \Request::get('search', '') }}" class="form-control bg-light border-0 small" placeholder="@lang('Search Job title..')" aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                          <i class="fas fa-search fa-sm"></i>
                      </button>
                  </div>
              </div>
          </form>
          <a href="{{ route('settings.jobs.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> @lang('Create job')
          </a>
        </div>   
</div>

<div class="row">
    <div class="col-md-12">
        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                     <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Company Info')</th>
                                <th>@lang('Job Info')</th>
                                <th>@lang('City')</th>
                                <th>@lang('Info')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($data as $item)
                            <tr>
                               <td>
                                   <small>@lang('Name'): {{$item->company->company_name}}</small><br>
                                   <small>@lang('Email'): {{$item->company->company_email}}</small>
                               </td>
                               <td>
                                <small>@lang('Job Tile'): {{$item->title}}</small><br>
                                <small>
                                    @isset($item->functional_area->name)
                                        {{ $item->functional_area->name }}
                                    @endisset
                                </small>
                               </td>
                               <td>
                                <small>
                                @isset($item->city->name)
                                    {{ $item->city->name }}
                                @endisset
                                </small>
                               </td>

                               <td>
                                    @if($item->is_active)
                                        <span class="small text-success"><i class="fas fa-check-circle"></i> @lang('Active')</span>
                                    @else
                                        <span class="small text-danger"><i class="fas fa-times-circle"></i> @lang('No Active')</span>
                                    @endif
                                    <br>
                                    @if($item->is_featured)
                                        <span class="small text-primary"><i class="fas fa-check-circle"></i> @lang('Featured')</span>
                                    @endif
                                </td>
                                <td>
                                     <div class="d-flex">
                                        <div class="p-1">
                                              <a href="{{ route('settings.jobs.edit', $item) }}"><span  class="badge badge-primary">@lang('Edit')</span></a>
                                        </div>
                                        <div class="p-1 ">
                                              <a href="{{ route('tracklink.show', ['target_class' => 'job', 'target_id' => $item->id]) }}"><span  class="badge badge-dark"><i class="fas fa-chart-pie"></i> @lang('Statistics')</span></a>
                                        </div>
                                        <div class="p-1">
                                              <a href="{{route('job',$item->slug)}}"><span  class="badge badge-primary"><i class="far fa-eye"></i> @lang('Job public')</span></a>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="p-1 ">
                                                <form method="post" action="{{ route('settings.jobs.destroy', $item->id) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger border-0">
                                                        @lang('Delete')
                                                    </button>
                                                </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="mt-4">
            {{ $data->appends( Request::all() )->links() }}
        </div>
    </div>
    
</div>

<div class="row">
  <div class="col-lg-12">
    @if($data->count() == 0)
    <div class="text-center">
      <div class="error mx-auto mb-3"><i class="fas fa-briefcase"></i></div>
      <p class="lead text-gray-800">@lang('No Jobs Found')</p>
      <p class="text-gray-500">@lang("You don't have any job").</p>
      <a href="{{ route('settings.jobs.create')}}" class="btn btn-primary">
        <span class="text">@lang('New Job')</span>
      </a>
    </div>
    @endif
  </div>
</div>

@stop