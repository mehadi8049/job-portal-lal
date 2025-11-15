
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
                                <h3><strong>@lang('Discover now all company on') {{ config('app.name')}}</strong></h3>
                            </div>
                        </div>
                        <form id="form_companies_search" action="javascript:void(0);">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input class="form-control" value="" placeholder="@lang('Company title, keywords...')" id="keyword" autocomplete="off">
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
                                    <select class="form-control" id="industry" tabindex="-1" aria-hidden="true">
                                        <option value="">@lang('All Industries')</option>
                                        @foreach($industries as $industry)
                                        <option value="{{ $industry->id }}" {{ $filter_industry_id == $industry->id ? 'selected' : '' }}>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-block"><i class="pe-7s-search"></i> @lang('Find')</button>
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
                     <div class="row mt-4 mb-4">
                        @foreach($data as $item)
                        @if(isset($item->user))
                            <div class="col-md-4 col-lg-3">
                                @include('themes::default.includes.item_company', ['company' => $item])
                            </div>
                        @endif
                        @endforeach
                     </div>
                     <div class="row justify-content-end my-5">
                            <div class="col-auto">
                                {{ $data->appends( Request::all() )->links() }}
                            </div>
                        </div>
                 </div>
             </div>
         </div>
     </section>
@stop

@push('scripts')
<script type="text/javascript">
    var url_search_companies = "{{ route('companies', ['q' => ':q']) }}";
</script>
@endpush