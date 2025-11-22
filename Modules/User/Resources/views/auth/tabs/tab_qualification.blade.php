<div class="tab-pane {{request()->tab=='qualification'?'active':''}}" id="tab_qualification">
    <div id="qualification_according">
        @foreach ($user->qualifications as $qualification)
            <div class="card">
                <div class="card-header" id="headingqualification{{ $qualification->id }}">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapsequalification{{ $qualification->id }}" aria-expanded="true"
                            aria-controls="collapsequalification{{ $qualification->id }}">
                            Qualification/Training History {{ $loop->index + 1 }}
                        </button>
                    </h5>
                </div>

                <div id="collapsequalification{{ $qualification->id }}" class="collapse show"
                    aria-labelledby="headingqualification{{ $qualification->id }}" data-parent="#qualification_according">
                    <div class="card-body">
                        <form role="form" method="post"
                            action="{{ route('qualification.update', $qualification->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Education Level -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Education Level <span class="text-danger">*</span></label>
                                    <input type="text" name="education_level" value="{{old('education_level',$qualification->education_level)}}" class="form-control" required>
                                </div>

                                <!-- Degree Title -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Degree Title <span class="text-danger">*</span></label>
                                    <input type="text" name="degree_title" value="{{old('degree_title',$qualification->degree_title)}}" class="form-control" required>
                                </div>

                                <!-- Major -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Concentration/ Major/Group</label>
                                    <input type="text" name="major" value="{{old('major',$qualification->major)}}" class="form-control">
                                </div>

                                <!-- Institute Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Institute Name</label>
                                    <input type="text" name="institute_name" value="{{old('institute_name',$qualification->institute_name)}}" class="form-control">
                                </div>

                                <!-- Result Type -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Result Type</label>
                                    <select name="result_type" class="form-control">
                                        <option value="" selected>Select One</option>
                                        <option value="GPA" {{old('result_type',$qualification->result_type)=='GPA'?'selected':''}}>GPA</option>
                                        <option value="CGPA" {{old('result_type',$qualification->result_type)=='CGPA'?'selected':''}}>CGPA</option>
                                        <option value="Division" {{old('result_type',$qualification->result_type)=='Division'?'selected':''}}>Division</option>
                                        <option value="Percentage" {{old('result_type',$qualification->result_type)=='Percentage'?'selected':''}}>Percentage</option>
                                    </select>
                                </div>

                                <!-- CGPA -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CGPA</label>
                                    <input type="number" step="0.01" max="5" min="0" name="cgpa" value="{{old('cgpa',$qualification->cgpa)}}"
                                        class="form-control">
                                </div>

                                <!-- Scale -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Scale</label>
                                    <input type="number" name="scale" value="{{old('scale',$qualification->scale)}}" class="form-control" placeholder="e.g. 5 or 4">
                                </div>

                                <!-- Passing Year -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Passing Year</label>
                                    <input type="number" name="passing_year" class="form-control" placeholder="YYYY"
                                        min="1950" max="{{ date('Y') }}" value="{{old('passing_year',$qualification->passing_year)}}">
                                </div>

                                <!-- Duration (Years) -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Duration (Years)</label>
                                    <input type="number" name="duration_years" class="form-control" min="1"
                                        max="10" value="{{old('duration_years',$qualification->duration_years)}}">
                                </div>

                                <!-- Achievement -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Achievement</label>
                                    <textarea name="achievement" value="{{old('achievement',$qualification->achievement)}}" class="form-control" rows="3" placeholder="Any academic achievement"></textarea>
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
            <div class="d-none" id="add-qualification-form">
                <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <!-- Education Level -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Education Level <span class="text-danger">*</span></label>
                            <input type="text" name="education_level" value="{{old('education_level')}}" class="form-control" required>
                        </div>

                        <!-- Degree Title -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Degree Title <span class="text-danger">*</span></label>
                            <input type="text" name="degree_title" value="{{old('degree_title')}}" class="form-control" required>
                        </div>

                        <!-- Major -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Concentration/ Major/Group</label>
                            <input type="text" name="major" value="{{old('major')}}" class="form-control">
                        </div>

                        <!-- Institute Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Institute Name</label>
                            <input type="text" name="institute_name" value="{{old('institute_name')}}" class="form-control">
                        </div>

                        <!-- Result Type -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Result Type</label>
                            <select name="result_type" class="form-control">
                                <option value="" selected>Select One</option>
                                <option value="GPA" {{old('result_type')=='GPA'?'selected':''}}>GPA</option>
                                <option value="CGPA" {{old('result_type')=='CGPA'?'selected':''}}>CGPA</option>
                                <option value="Division" {{old('result_type')=='Division'?'selected':''}}>Division</option>
                                <option value="Percentage" {{old('result_type')=='Percentage'?'selected':''}}>Percentage</option>
                            </select>
                        </div>

                        <!-- CGPA -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CGPA</label>
                            <input type="number" step="0.01" max="5" min="0" name="cgpa" value="{{old('cgpa')}}"
                                class="form-control">
                        </div>

                        <!-- Scale -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Scale</label>
                            <input type="number" name="scale" value="{{old('scale')}}" class="form-control" placeholder="e.g. 5 or 4">
                        </div>

                        <!-- Passing Year -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Passing Year</label>
                            <input type="number" name="passing_year" value="{{old('passing_year')}}" class="form-control" placeholder="YYYY"
                                min="1950" max="{{ date('Y') }}">
                        </div>

                        <!-- Duration (Years) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (Years)</label>
                            <input type="number" name="duration_years" value="{{old('duration_years')}}" class="form-control" min="1"
                                max="10">
                        </div>

                        <!-- Achievement -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Achievement</label>
                            <textarea name="achievement" class="form-control" rows="3" placeholder="Any academic achievement">{{old('achievement')}}</textarea>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="need_update"
                                    value="qualification">
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
                        <button type="button" class="btn btn-primary" id="add-qualification">
                            <i class="fa fa-plus mr-2"></i> @lang('Add Qualification/Training (If Required)')
                        </button>
                        <button type="button" class="btn btn-danger" id="cancel-qualification">
                            <i class="fa fa-times mr-2"></i> @lang('Cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
