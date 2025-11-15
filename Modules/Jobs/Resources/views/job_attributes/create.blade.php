@extends('core::layouts.app')

@section('title', $translates['title_create'])

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $translates['title_create'] }}</h1>
</div>
<div class="row">
    <div class="col-md-12">

        <form role="form" method="post" action="{{ route('settings.job.attributes.' . $attr_route . '.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-label">{{ $translates['Name'] }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ $translates['Name'] }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Is default')</label>
                                <div>
                                    <label><input type="radio" name="is_default" value="1" {{ old('is_default', '1') == '1' ? 'checked' : '' }}> @lang('Yes')</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="is_default" value="0" {{ old('is_default', '1') == '0' ? 'checked' : '' }}> @lang('No')</label>
                                </div>
                                @error('is_default')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">@lang('Is active')</label>
                                <div>
                                    <label><input type="radio" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}> @lang('Active')</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="is_active" value="0" {{ old('is_active', '1') == '0' ? 'checked' : '' }}> @lang('In-active')</label>
                                </div>
                                @error('is_active')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.job.attributes.' . $attr_route . '.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-primary ml-auto">@lang('Save')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>


@stop