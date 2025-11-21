<div class="tab-pane" id="tab_Language_proficiency">
    <div id="language_according">
        @foreach ($user->languageProficiencies as $language)
            <div class="card">
                <div class="card-header" id="headinglanguage{{ $language->id }}">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse"
                            data-target="#collapselanguage{{ $language->id }}" aria-expanded="true"
                            aria-controls="collapselanguage{{ $language->id }}">
                            Language {{ $loop->index + 1 }}
                        </button>
                    </h5>
                </div>

                <div id="collapselanguage{{ $language->id }}" class="collapse show"
                    aria-labelledby="headinglanguage{{ $language->id }}" data-parent="#language_according">
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('job.language.update', $language->id) }}"
                            autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Language Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Language Name</label>
                                    <input type="text" name="language_name" class="form-control"
                                        placeholder="e.g. English, Bangla, Hindi">
                                </div>

                                <!-- Reading Level -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Reading</label>
                                    <select name="reading_level" class="form-control">
                                        <option value="" selected>Select</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>

                                <!-- Writing Level -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Writing</label>
                                    <select name="writing_level" class="form-control">
                                        <option value="" selected>Select</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>

                                <!-- Speaking Level -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Speaking</label>
                                    <select name="speaking_level" class="form-control">
                                        <option value="" selected>Select</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
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
            <div class="d-none" id="add-language-form">
                <form role="form" method="post" action="{{ route('accountsettings.update') }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <!-- Language Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Language Name</label>
                            <input type="text" name="language_name" class="form-control"
                                placeholder="e.g. English, Bangla, Hindi">
                        </div>

                        <!-- Reading Level -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Reading</label>
                            <select name="reading_level" class="form-control">
                                <option value="" selected>Select</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                        <!-- Writing Level -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Writing</label>
                            <select name="writing_level" class="form-control">
                                <option value="" selected>Select</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                        <!-- Speaking Level -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Speaking</label>
                            <select name="speaking_level" class="form-control">
                                <option value="" selected>Select</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="need_update" value="LanguageProficiency">
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
                        <button type="button" class="btn btn-primary" id="add-language">
                            <i class="fa fa-plus mr-2"></i> @lang('Add Language (If Required)')
                        </button>
                        <button type="button" class="btn btn-danger" id="cancel-language">
                            <i class="fa fa-times mr-2"></i> @lang('Cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
