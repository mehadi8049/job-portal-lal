@extends('core::layouts.app')
@section('title', __('All Companies'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-4 text-gray-800">@lang('All Companies')</h1>
        <a href="{{ route('settings.companies.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> @lang('Create company')
        </a>
</div>

<div class="row">
    <div class="col-md-12">
        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                     <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Logo')</th>
                                <th>@lang('Company Info')</th>
                                <th>@lang('Employer Info')</th>
                                <th>@lang('Info')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($data as $item)
                            
                            <tr>
                               <td>
                                 
                                   <img src="{{ URL::to('/') }}/storage/user_storage/{{ $item->user_id. "/". $item->logo }}" width="50" height="50">
                               </td>
                               <td>
                                   <small>@lang('Name'): {{$item->company_name}}</small><br>
                                   <small>@lang('Email'): {{$item->company_email}}</small>
                               </td>
                               <td>
                                  @if(isset($employer))
                                   <small>@lang('Name'): {{$employer->name}}</small><br>
                                   <small>@lang('Email'): {{$employer->email}}</small>
                                  @endif
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
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-ellipsis-h"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-top">
                                    <a href="{{ route('settings.companies.edit', $item) }}" class="dropdown-item">@lang('Edit')</a>
                                    <a href="{{route('company',$item->slug)}}" class="dropdown-item">@lang('Public Profile')</a>
                                    <form method="post" action="{{ route('settings.companies.destroy', $item->id) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                      @csrf
                                      @method('DELETE')
                                        <button type="submit" class="dropdown-item">@lang('Delete')</button>
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
      <div class="error mx-auto mb-3"><i class="fas fa-building"></i></div>
      <p class="lead text-gray-800">@lang('No Companies Found')</p>
      <p class="text-gray-500">@lang("You don't have any companies").</p>
      <a href="{{ route('settings.companies.create')}}" class="btn btn-primary">
        <span class="text">@lang('New Company')</span>
      </a>
    </div>
    @endif
  </div>
</div>

@stop