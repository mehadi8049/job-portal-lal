<div class="tab-pane active" id="tab_profile">
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        Personal Information
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Name')</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Full name')">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" value="{{ $user->email }}" class="form-control disabled"
                                        placeholder="E-mail" disabled>
                                    <small class="help-block">@lang("E-mail can't be changed")</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Password')</label>
                                    <input type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        name="password" placeholder="@lang('Password')">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Confirm password')</label>
                                    <input type="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        name="password_confirmation" placeholder="@lang('Confirm password')">
                                </div>
                                <div class="alert alert-info">
                                    @lang('Type new password if you would like to change current password.')
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Father Name')</label>
                                    <input type="text" name="father_name" value="{{ $user->father_name }}"
                                        class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Father Name')">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Mother Name')</label>
                                    <input type="text" name="mother_name" value="{{ $user->mother_name }}"
                                        class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Mother Name')">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Date of Birth')</label>
                                    <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}"
                                        class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Date of Birth')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Gender')</label>
                                    <input type="text" name="gender" value="{{ $user->gender }}"
                                        class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Gender')">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Religion')</label>
                                    <input type="text" name="religion" value="{{ $user->religion }}"
                                        class="form-control {{ $errors->has('religion') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Religion')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Marital Status')</label>
                                    <input type="text" name="marital_status" value="{{ $user->marital_status }}"
                                        class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Marital Status')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Nationality')</label>
                                    <input type="text" name="nationality" value="{{ $user->nationality }}"
                                        class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Nationality')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('National ID')</label>
                                    <input type="text" name="national_id" value="{{ $user->national_id }}"
                                        class="form-control {{ $errors->has('national_id') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('National ID')">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Passport Number')</label>
                                    <input type="text" name="passport_number"
                                        value="{{ $user->passport_number }}"
                                        class="form-control {{ $errors->has('passport_number') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Passport Number')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Passport Issue Date')</label>
                                    <input type="date" name="passport_issue_date"
                                        value="{{ $user->passport_issue_date }}"
                                        class="form-control {{ $errors->has('passport_issue_date') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Passport Issue Date')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Primary Mobile')</label>
                                    <input type="text" name="primary_mobile" value="{{ $user->primary_mobile }}"
                                        class="form-control {{ $errors->has('primary_mobile') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Primary Mobile')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Secondary Mobile')</label>
                                    <input type="text" name="secondary_mobile"
                                        value="{{ $user->secondary_mobile }}"
                                        class="form-control {{ $errors->has('secondary_mobile') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Secondary Mobile')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Emergency Contact')</label>
                                    <input type="text" name="emergency_contact"
                                        value="{{ $user->emergency_contact }}"
                                        class="form-control {{ $errors->has('emergency_contact') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Emergency Contact')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Alternate Email')</label>
                                    <input type="email" name="alternate_email"
                                        value="{{ $user->alternate_email }}"
                                        class="form-control {{ $errors->has('alternate_email') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Alternate Email')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Blood Group')</label>
                                    <input type="text" name="blood_group" value="{{ $user->blood_group }}"
                                        class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Blood Group')">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Weight (KG)')</label>
                                    <input type="text" name="weight_kg" value="{{ $user->weight_kg }}"
                                        class="form-control {{ $errors->has('weight_kg') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Weight (KG)')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Height (Meters)')</label>
                                    <input type="text" name="height_meters" value="{{ $user->height_meters }}"
                                        class="form-control {{ $errors->has('height_meters') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Height (Meters)')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="need_update"
                                        value="personal">
                                        <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Address
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Present Address')</label>
                                    <textarea name="present_address" class="form-control {{ $errors->has('present_address') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Present Address')" rows="3">{{ old('present_address', $user->present_address) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Permanent Address')</label>
                                    <textarea name="parmanent_address" class="form-control {{ $errors->has('parmanent_address') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Permanent Address')" rows="3">{{ old('parmanent_address', $user->parmanent_address) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="need_update"
                                        value="address">
                                        <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTree">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                        data-target="#collapseTtree" aria-expanded="false" aria-controls="collapseTtree">
                        Career and Application Information
                    </button>
                </h5>
            </div>
            <div id="collapseTtree" class="collapse" aria-labelledby="headingTree" data-parent="#accordion">
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Objective')</label>
                                    <textarea name="objective" class="form-control {{ $errors->has('objective') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Objective')" rows="3">{{ $user->objective }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Present Salary')</label>
                                    <input type="text" name="present_salary" value="{{ $user->present_salary }}"
                                        class="form-control {{ $errors->has('present_salary') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Present Salary')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Expected Salary')</label>
                                    <input type="text" name="expected_salary"
                                        value="{{ $user->expected_salary }}"
                                        class="form-control {{ $errors->has('expected_salary') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Expected Salary')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Job Level')</label>
                                    <input type="text" name="job_level" value="{{ $user->job_level }}"
                                        class="form-control {{ $errors->has('job_level') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Job Level')">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">@lang('Job Nature')</label>
                                    <input type="text" name="job_nature" value="{{ $user->job_nature }}"
                                        class="form-control {{ $errors->has('job_nature') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Job Nature')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="need_update"
                                        value="career_application">
                                        <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Other Relavand Information
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Career Summary')</label>
                                    <textarea name="career_summary" class="form-control {{ $errors->has('career_summary') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Career Summary')" rows="3">{{ $user->career_summary }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Special Qualification')</label>
                                    <textarea name="special_qualification"
                                        class="form-control {{ $errors->has('special_qualification') ? 'is-invalid' : '' }}"
                                        placeholder="@lang('Special Qualification')" rows="3">{{ $user->special_qualification }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('Keywords')</label>

                                    <div id="tag-container" class="form-control p-2" style="height:auto;">
                                        <input type="text" name="keywords[]" id="tag-input" placeholder="@lang('Type and press Enter')"
                                            style="border:0;outline:0;width:auto;">
                                    </div>

                                    <div id="keywords-hidden"></div>

                                    @if ($errors->has('keywords'))
                                        <span class="text-danger">{{ $errors->first('keywords') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="need_update"
                                        value="other_relavand">
                                        <i class="fa fa-save mr-2"></i> @lang('Save Change')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
