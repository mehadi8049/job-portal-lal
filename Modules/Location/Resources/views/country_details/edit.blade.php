@extends('core::layouts.app')

@section('title', __('Edit Country Detail'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Edit Country Detail')</h1>
</div>
<div class="row">
    <div class="col-md-12">

        <form role="form" method="post" action="{{ route('settings.location.country_details.update', ['id' => $item->id]) }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-label">@lang('Country')</label>
                                <input type="text" name="country_name" value="{{ old('country_name', $item->country->name) }}" class="form-control" placeholder="@lang('Country')">
                                @error('country_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Sort name')</label>
                                <input type="text" name="sort_name" value="{{ old('sort_name', $item->sort_name) }}" class="form-control" placeholder="@lang('Sort name')">
                                @error('sort_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Phone code')</label>
                                <input type="text" name="phone_code" value="{{ old('phone_code', $item->phone_code) }}" class="form-control" placeholder="@lang('Phone code')">
                                @error('phone_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Currency')</label>
                                <input type="text" name="currency" value="{{ old('currency', $item->currency) }}" class="form-control" placeholder="@lang('Currency')">
                                @error('currency')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Code')</label>
                                <input type="text" name="code" value="{{ old('code', $item->code) }}" class="form-control" placeholder="@lang('Code')">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Symbol')</label>
                                <input type="text" name="symbol" value="{{ old('symbol', $item->symbol) }}" class="form-control" placeholder="@lang('Symbol')">
                                @error('symbol')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Thousand separator')</label>
                                <input type="text" name="thousand_separator" value="{{ old('thousand_separator', $item->thousand_separator) }}" class="form-control" placeholder="@lang('Thousand separator')">
                                @error('thousand_separator')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Decimal separator')</label>
                                <input type="text" name="decimal_separator" value="{{ old('decimal_separator', $item->decimal_separator) }}" class="form-control" placeholder="@lang('Decimal separator')">
                                @error('decimal_separator')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('settings.location.country_details.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <div>
                            <button class="btn btn-primary">@lang('Save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>


@stop