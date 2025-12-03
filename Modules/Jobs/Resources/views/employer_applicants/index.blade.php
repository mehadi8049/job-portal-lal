@extends('core::layouts.app')
@section('title', __('All Applicants'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-4 text-gray-800">@lang('All Applicants')</h1>
        <div class="ml-auto d-sm-flex">
          <form method="get" action="" class="navbar-search mr-4">
              <div class="input-group">
                  <input type="text" name="search" value="{{ \Request::get('search', '') }}" class="form-control bg-light border-0 small" placeholder="@lang('Search full name..')" aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                          <i class="fas fa-search fa-sm"></i>
                      </button>
                  </div>
              </div>
          </form>
        </div>        
</div>
<div class="row">
    <div class="col-md-12">
        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                     <table class="table card-table table-vcenter">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Job Info')</th>
                                <th>@lang('Applicants Info')</th>
                                <th>@lang('Description')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($data as $item)
                            <tr>
                              
                               <td>
                                @if(isset($item->job))
                                <small>@lang('Job Tile'): 
                                  <a href="{{ route('company.jobs.edit', $item) }}" class="text-dark">
                                    <strong>{{$item->job->title}}</strong>
                                  </a>
                                </small>
                                @endif
                               </td>
                               <td>
                                 <small><strong>@lang('Full name')</strong>: {{$item->fullname}}</small><br>
                                 <small><strong>@lang('Email')</strong>: {{$item->email}}</small>
                               </td>

                               <td class="td_description">
                               <small>{{$item->description}}</small>
                              </td>
                              
                                <td>
                                  <div class="d-flex">
                                        <div class="p-1"> 
                                          @if($item->resume_link)
                                            <a href="{{ $item->resume_link }}">
                                              <span class="badge badge-success">@lang('View Resume')</span>
                                            </a>
                                          @elseif($item->resume_pdf)
                                            <a href="{{ URL::to('/') }}/storage/resume_cvs_apply/{{ $item->resume_pdf }}">
                                              <span class="badge badge-info">@lang('View Resume')</span>
                                            </a>
                                          @endif
                                        </div>
                                        <div class="p-1"> 
                                          <form method="post" action="{{ route('company.applicants.destroy', $item->id) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                              @csrf
                                              @method('DELETE')
                                                <button type="submit" class="badge badge-danger border-0">@lang('Delete')</button>
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
      <div class="error mx-auto mb-3"><i class="fas fa-bullhorn"></i></div>
      <p class="lead text-gray-800">@lang('No Applicants Found')</p>
      <p class="text-gray-500">@lang("You don't have any applicants. Please share your jobs for candidates").</p>
    </div>
    @endif
  </div>
</div>

@stop