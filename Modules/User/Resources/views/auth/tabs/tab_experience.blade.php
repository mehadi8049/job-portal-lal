<div class="tab-pane" id="tab_experience">
    <div id="experince_according">
        @foreach ($user->experiences as $experience)
            <div class="card">
                <div class="card-header" id="headingExperience{{ $experience->id }}">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapseExperience{{ $experience->id }}" aria-expanded="true"
                            aria-controls="collapseExperience{{ $experience->id }}">
                            Experience History {{ $loop->index + 1 }}
                        </button>
                    </h5>
                </div>

                <div id="collapseExperience{{ $experience->id }}" class="collapse show"
                    aria-labelledby="headingExperience{{ $experience->id }}" data-parent="#experince_according">
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('experience.update',$experience->id) }}"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Company Name')</label>
                                    <input type="text" name="company_name"
                                        value="{{ old('company_name', $experience->company_name) }}"
                                        class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Company Name')">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Business Type')</label>
                                    <input type="text" name="company_business"
                                        value="{{ old('company_business', $experience->company_business) }}"
                                        class="form-control {{ $errors->has('company_business') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Business Type')">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Designation')</label>
                                    <input type="text" name="designation"
                                        value="{{ old('designation', $experience->designation) }}"
                                        class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Designation')">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Department')</label>
                                    <input type="text" name="department"
                                        value="{{ old('department', $experience->department) }}"
                                        class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Department')">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Employment From')</label>
                                    <input type="date" name="employment_from"
                                        value="{{ old('employment_from', $experience->employment_from) }}"
                                        class="form-control {{ $errors->has('employment_from') ? 'is-invalid' : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Employment To')</label>
                                    <input type="date" name="employment_to"
                                        value="{{ old('employment_to', $experience->employment_to) }}"
                                        class="form-control {{ $errors->has('employment_to') ? 'is-invalid' : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-4">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="is_current" value="1"
                                            {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                                        @lang('Currently Working')
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Responsibilities')</label>
                                    <textarea name="responsibilities" rows="3"
                                        class="form-control {{ $errors->has('responsibilities') ? 'is-invalid' : '' }}" placeholder="@lang('Responsibilities')">{{ old('responsibilities', $user->responsibilities) }}</textarea>
                                </div>
                            </div>

                            {{-- JSON tag input (Area of Expertise) --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Area of Expertise')</label>

                                    <div id="expertise-container" class="form-control p-2" style="height:auto;">
                                        <input type="text" id="expertise-input" placeholder="@lang('Type and press Enter')"
                                            style="border:0;outline:0;width:auto;">
                                    </div>

                                    <div id="expertise-hidden"></div>

                                    @if ($errors->has('area_of_expertise'))
                                        <span class="text-danger">{{ $errors->first('area_of_expertise') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Company Location')</label>
                                    <input type="text" name="company_location"
                                        value="{{ old('company_location', $user->company_location) }}"
                                        class="form-control {{ $errors->has('company_location') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Company Location')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-none" id="add-experience-form">
                <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Company Name')</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}"
                                    class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                    placeholder="@lang('Company Name')">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Business Type')</label>
                                <input type="text" name="company_business" value="{{ old('company_business') }}"
                                    class="form-control {{ $errors->has('company_business') ? 'is-invalid' : '' }}"
                                    placeholder="@lang('Business Type')">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Designation')</label>
                                <input type="text" name="designation" value="{{ old('designation') }}"
                                    class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                    placeholder="@lang('Designation')">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Department')</label>
                                <input type="text" name="department" value="{{ old('department') }}"
                                    class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}"
                                    placeholder="@lang('Department')">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Employment From')</label>
                                <input type="date" name="employment_from" value="{{ old('employment_from') }}"
                                    class="form-control {{ $errors->has('employment_from') ? 'is-invalid' : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Employment To')</label>
                                <input type="date" name="employment_to" value="{{ old('employment_to') }}"
                                    class="form-control {{ $errors->has('employment_to') ? 'is-invalid' : '' }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mt-4">
                                <label class="form-check-label">
                                    <input type="checkbox" name="is_current" value="1"
                                        {{ old('is_current') ? 'checked' : '' }}>
                                    @lang('Currently Working')
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Responsibilities')</label>
                                <textarea name="responsibilities" rows="3"
                                    class="form-control {{ $errors->has('responsibilities') ? 'is-invalid' : '' }}" placeholder="@lang('Responsibilities')">{{ old('responsibilities') }}</textarea>
                            </div>
                        </div>

                        {{-- JSON tag input (Area of Expertise) --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Area of Expertise')</label>

                                <div id="expertise-container" class="form-control p-2" style="height:auto;">
                                    <input type="text" id="expertise-input" placeholder="@lang('Type and press Enter')"
                                        style="border:0;outline:0;width:auto;">
                                </div>

                                <div id="expertise-hidden"></div>

                                @if ($errors->has('area_of_expertise'))
                                    <span class="text-danger">{{ $errors->first('area_of_expertise') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Company Location')</label>
                                <input type="text" name="company_location" value="{{ old('company_location') }}"
                                    class="form-control {{ $errors->has('company_location') ? 'is-invalid' : '' }}"
                                    placeholder="@lang('Company Location')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="need_update"
                                    value="experience">
                                    <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-left">
                        <button type="button" class="btn btn-primary" id="add-experience">
                            <i class="fa fa-plus mr-2"></i> @lang('Add Experience (If Required)')
                        </button>
                        <button type="button" class="btn btn-danger" id="cancel-experience">
                            <i class="fa fa-times mr-2"></i> @lang('Cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
