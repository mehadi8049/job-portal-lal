@extends('core::layouts.app')

@section('title', __('Create New Link'))

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Create New Link')</h1>
    </div>
    <div class="row">
        <div class="col-md-12">

            <form role="form" method="post" action="{{ route('quick-link.store') }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Title')</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Link/Url')</label>
                                    <input type="url" name="link_url" value="{{ old('link_url') }}" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Serial')</label>
                                    <input type="number" name="serial" value="{{ old('serial') }}" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }}
                                            class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">@lang('Allow active link')</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="{{ route('quick-link.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                            <button class="btn btn-primary ml-auto">@lang('Save')</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
@stop
