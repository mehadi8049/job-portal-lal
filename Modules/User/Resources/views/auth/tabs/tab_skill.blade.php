<div class="tab-pane {{request()->tab=='skill'?'active':''}}" id="tab_skill">
    <div id="skill_according">
        @foreach ($user->skills as $skill)
            <div class="card">
                <div class="card-header" id="headingskill{{ $skill->id }}">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapseskill{{ $skill->id }}" aria-expanded="true"
                            aria-controls="collapseskill{{ $skill->id }}">
                            Skill History {{ $loop->index + 1 }}
                        </button>
                    </h5>
                </div>

                <div id="collapseskill{{ $skill->id }}" class="collapse show"
                    aria-labelledby="headingskill{{ $skill->id }}" data-parent="#skill_according">
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('skill.update', $skill->id) }}"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Skill Name -->
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Skill Name</label>
                                    <input type="text" name="skill_name" value="{{old('skill',$skill->skill_name)}}" class="form-control"
                                        placeholder="e.g. Laravel, React, SEO">
                                </div>

                                <!-- Skill Learned From (JSON) -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Skill Learned From</label>

                                    <select name="skill_learned_from[]" class="form-control" multiple>
                                        <option value="Academic" {{in_array('Academic',old('skill_learned_from',$skill->skill_learned_from))?'selected':''}}>Academic</option>
                                        <option value="Training Center" {{in_array('Training Center',old('skill_learned_from',$skill->skill_learned_from))?'selected':''}}>Training Center</option>
                                        <option value="Online Course" {{in_array('Online Course',old('skill_learned_from',$skill->skill_learned_from))?'selected':''}}>Online Course</option>
                                        <option value="Self Learning" {{in_array('Self Learning',old('skill_learned_from',$skill->skill_learned_from))?'selected':''}}>Self Learning</option>
                                        <option value="Job Experience" {{in_array('Job Experience',old('skill_learned_from',$skill->skill_learned_from))?'selected':''}}>Job Experience</option>
                                    </select>

                                    <small class="text-muted">
                                        You can select multiple options (stored as JSON).
                                    </small>
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
            <div class="d-none" id="add-skill-form">
                <form role="form" method="post" action="{{ route('accountsettings.update') }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Skill Name -->
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Skill Name</label>
                            <input type="text" name="skill_name" class="form-control" value="{{old('skill_name')}}"
                                placeholder="e.g. Laravel, React, SEO">
                        </div>

                        <!-- Skill Learned From (JSON) -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Skill Learned From</label>

                            <select name="skill_learned_from[]" class="form-control" multiple>
                                <option value="Academic" {{in_array('Academic',old('skill_learned_from',[]))?'selected':''}}>Academic</option>
                                        <option value="Training Center" {{in_array('Training Center',old('skill_learned_from',[]))?'selected':''}}>Training Center</option>
                                        <option value="Online Course" {{in_array('Online Course',old('skill_learned_from',[]))?'selected':''}}>Online Course</option>
                                        <option value="Self Learning" {{in_array('Self Learning',old('skill_learned_from',[]))?'selected':''}}>Self Learning</option>
                                        <option value="Job Experience" {{in_array('Job Experience',old('skill_learned_from',[]))?'selected':''}}>Job Experience</option>
                            </select>

                            <small class="text-muted">
                                You can select multiple options (stored as JSON).
                            </small>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="need_update" value="skill">
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
                        <button type="button" class="btn btn-primary" id="add-skill">
                            <i class="fa fa-plus mr-2"></i> @lang('Add Skill (If Required)')
                        </button>
                        <button type="button" class="btn btn-danger" id="cancel-skill">
                            <i class="fa fa-times mr-2"></i> @lang('Cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
