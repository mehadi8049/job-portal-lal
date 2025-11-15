@extends('core::layouts.app')

@section('title', __('Create Job'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Create Job')</h1>
</div>
<div class="row">
    <div class="col-md-12">

        <form role="form" method="post" action="{{ route('company.jobs.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">@lang('Title')</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('City')</label>
                                <select name="city_id" class="form-control" required>
                                    @foreach($cities as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-label">@lang('Active')</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="is_active" class="custom-switch-input" value="1">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Allow active job')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">@lang('Job featured')</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="is_featured" class="custom-switch-input" value="1">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Enable Job featured')</span>
                                    <br><small class="text-primary">(@lang('With job featured your job will be a prominent badge, show up on website homepage, suggestions for candidates...'))</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Description')</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Responbilities')</label>
                                <textarea name="responbilities" id="responbilities" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Requirements')</label>
                                <textarea name="requirements" id="requirements" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">@lang('Salary from')</label>
                                <input type="number" min="0" step="1" name="salary_from" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">@lang('Salary to')</label>
                                <input type="number" min="0" step="1" name="salary_to" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">@lang('Salary Currency')</label>
                                <select name="salary_currency" class="form-control" required="">
                                    @foreach(getCurencies() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Salary period')</label>
                                <select name="salary_period_id" class="form-control" required="">
                                    @foreach($salaryPeriods as $salaryPeriod)
                                        <option value="{{ $salaryPeriod->id }}">{{ $salaryPeriod->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Career level')</label>
                                <select name="career_level_id" class="form-control" required="">
                                    @foreach($careerLevels as $careerLevel)
                                        <option value="{{ $careerLevel->id }}">{{ $careerLevel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Functional Area')</label>
                                <select name="functional_area_id" class="form-control" required="">
                                    @foreach($functionalAreas as $functionalArea)
                                        <option value="{{ $functionalArea->id }}">{{ $functionalArea->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Gender')</label>
                                <select name="gender_id" class="form-control" required="">
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Job type')</label>
                                <select name="job_type_id" class="form-control" required="">
                                    @foreach($jobTypes as $jobType)
                                        <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Job shift')</label>
                                <select name="job_shift_id" class="form-control" required="">
                                    @foreach($jobShifts as $jobShift)
                                        <option value="{{ $jobShift->id }}">{{ $jobShift->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Expiry date')</label>
                                <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="expiry_date" value="" data-target="#expiry_date" />
                                    <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">@lang('Require degree level')</label>
                                <select name="degree_level_id" class="form-control" required="">
                                    @foreach($degreeLevels as $degreeLevel)
                                        <option value="{{ $degreeLevel->id }}">{{ $degreeLevel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">@lang('Require job experience')</label>
                                <select name="job_experience_id" class="form-control" required="">
                                    @foreach($jobExperiences as $jobExperience)
                                        <option value="{{ $jobExperience->id }}">{{ $jobExperience->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('company.jobs.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-primary ml-auto">@lang('Save')</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    
</div>
@stop

@push('scripts')
<script src="{{ Module::asset('jobs:js/employer_jobs.js') }}"></script>
@endpush