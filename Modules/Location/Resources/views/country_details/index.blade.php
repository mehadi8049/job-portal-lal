@extends('core::layouts.app')
@section('title', __('Country Details'))
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <div>
        <a href="{{ route('settings.location.countries.index') }}" class="btn btn-primary">@lang('Countries')</a>
      </div>
      <form method="get" action="" class="my-3 my-lg-0 navbar-search">
          <div class="input-group">
              <input type="text" name="search" value="{{ \Request::get('search', '') }}" class="form-control bg-light border-0 small" placeholder="@lang('Search')" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>
  </div>

<div class="row">
    <div class="col-md-12">
        @if($paginationData->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Country')</th>
                                <th>@lang('Sort name')</th>
                                <th>@lang('Phone code')</th>
                                <th>@lang('Currency')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Symbol')</th>
                                <th>@lang('Thousand separator')</th>
                                <th>@lang('Decimal separator')</th>

                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paginationData as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('settings.location.countries.edit', ['id' => $item->country->id]) }}">{{ $item->country->name }}</a>
                                </td>
                                <td>{{ $item->sort_name }}</td>
                                <td>{{ $item->phone_code }}</td>
                                <td>{{ $item->currency }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->symbol }}</td>
                                <td>{{ $item->thousand_separator }}</td>
                                <td>{{ $item->decimal_separator }}</td>
                                
                                <td>
                                    <a href="{{ route('settings.location.country_details.edit', ['id' => $item->id]) }}" class="btn btn-primary">@lang('Edit')</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="mt-4">
            {{ $paginationData->appends( Request::all() )->links() }}
        </div>
        
        @if($paginationData->count() == 0)
        <div class="alert alert-primary text-center">
            <i class="fe fe-alert-triangle mr-2"></i> @lang('No results')
        </div>
        @endif
    </div>
    
</div>

@stop