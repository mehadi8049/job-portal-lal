@extends('core::layouts.app')
@section('title', __('Account Settings'))

@push('css')
    <style>
        .card-header {
            border-bottom: 0;
        }
    </style>
@endpush
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Setting Account')</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" action="{{ route('accountsettings.update') }}" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab_profile" data-toggle="tab">
                                    @lang('Profile')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_experience" data-toggle="tab">
                                    @lang('Experience')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_qualification" data-toggle="tab">
                                    @lang('Qualification/Traning')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_skill" data-toggle="tab">
                                    @lang('Skill')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_preferred_job_category" data-toggle="tab">
                                    @lang('Preferred Job Category')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_Language_proficiency" data-toggle="tab">
                                    @lang('Language Proficiency')
                                </a>
                            </li>
                            @php
                                $views_render = accountSettingPayments(['user' => $user]);
                            @endphp

                            @if (!empty($views_render))
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_payment_setting" data-toggle="tab">
                                        @lang('Payment Settings')
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            @include('user::auth.tabs.tab_personal')
                            @include('user::auth.tabs.tab_experience')
                            @include('user::auth.tabs.tab_qualification')
                            @include('user::auth.tabs.tab_skill')
                            @include('user::auth.tabs.tab_preferred_job_category')
                            @include('user::auth.tabs.tab_Language_proficiency')


                            <div class="tab-pane" id="tab_payment_setting">
                                @if (!empty($views_render))
                                    {!! $views_render !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fe fe-save mr-2"></i> @lang('Save settings')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
