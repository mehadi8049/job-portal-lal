@extends('core::layouts.app')

@section('title', __('Edit Country'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Edit Country')</h1>
</div>
<div class="row">
    <div class="col-md-12">

        <form role="form" method="post" action="{{ route('settings.location.countries.update', ['id' => $item->id]) }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-label">@lang('Country')</label>
                                <input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control" placeholder="@lang('Country')">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Is default')</label>
                                <div>
                                    <label><input type="radio" name="is_default" value="1" {{ old('is_default', $item->is_default) == '1' ? 'checked' : '' }}> @lang('Yes')</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="is_default" value="0" {{ old('is_default', $item->is_default) == '0' ? 'checked' : '' }}> @lang('No')</label>
                                </div>
                                @error('is_default')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Is active')</label>
                                <div>
                                    <label><input type="radio" name="is_active" value="1" {{ old('is_active', $item->is_active) == '1' ? 'checked' : '' }}> @lang('Active')</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="is_active" value="0" {{ old('is_active', $item->is_active) == '0' ? 'checked' : '' }}> @lang('In-active')</label>
                                </div>
                                @error('is_active')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('settings.location.countries.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <div>
                            <a href="{{ route('settings.location.country_details.edit', ['id' => $item->detail->id]) }}" class="btn btn-info">@lang('Detail')</a>
                            <button class="btn btn-primary">@lang('Save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>


@stop