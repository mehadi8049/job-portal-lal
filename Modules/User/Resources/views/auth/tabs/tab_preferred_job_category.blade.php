<div class="tab-pane" id="tab_preferred_job_category">
    <div class="tab-pane" id="tab_category">
        <div id="category_according">
            @foreach ($user->preferredJobCategories as $category)
                <div class="card">
                    <div class="card-header" id="headingcategory{{ $category->id }}">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse"
                                data-target="#collapsecategory{{ $category->id }}" aria-expanded="true"
                                aria-controls="collapsecategory{{ $category->id }}">
                                Category {{ $loop->index + 1 }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapsecategory{{ $category->id }}" class="collapse show"
                        aria-labelledby="headingcategory{{ $category->id }}" data-parent="#category_according">
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('job.category.update', $category->id) }}"
                                autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <!-- Functional Area -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Functional Area</label>
                                        <input type="text" name="functional_area" class="form-control"
                                            placeholder="e.g. Web Development, Marketing">
                                    </div>

                                    <!-- Special Skills -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Special Skills</label>
                                        <textarea name="special_skills" class="form-control" rows="2"
                                            placeholder="e.g. Leadership, Communication, Creative thinking"></textarea>
                                    </div>

                                    <!-- Preferred Locations Inside Country -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Preferred Locations (Inside Bangladesh)</label>

                                        <select name="preferred_locations_inside[]" class="form-control" multiple>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Chattogram">Chattogram</option>
                                            <option value="Rajshahi">Rajshahi</option>
                                            <option value="Khulna">Khulna</option>
                                            <option value="Sylhet">Sylhet</option>
                                            <option value="Barishal">Barishal</option>
                                            <option value="Rangpur">Rangpur</option>
                                            <option value="Mymensingh">Mymensingh</option>
                                        </select>

                                        <small class="text-muted">Select multiple preferred work locations.</small>
                                    </div>

                                    <!-- Preferred Locations Outside Country -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Preferred Locations (Outside Bangladesh)</label>

                                        <select name="preferred_locations_outside[]" class="form-control" multiple>
                                            <option value="USA">USA</option>
                                            <option value="UK">UK</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="UAE">UAE</option>
                                            <option value="Japan">Japan</option>
                                        </select>

                                        <small class="text-muted">Select multiple international locations.</small>
                                    </div>

                                    <!-- Preferred Organization Types -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Preferred Organization Types</label>

                                        <select name="preferred_organization_types[]" class="form-control" multiple>
                                            <option value="Government">Government</option>
                                            <option value="Private Company">Private Company</option>
                                            <option value="International NGO">International NGO</option>
                                            <option value="Local NGO">Local NGO</option>
                                            <option value="Startup">Startup</option>
                                            <option value="Multinational Company">Multinational Company</option>
                                            <option value="Educational Institution">Educational Institution</option>
                                        </select>

                                        <small class="text-muted">Select multiple organization types.</small>
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
                <div class="d-none" id="add-category-form">
                    <form role="form" method="post" action="{{ route('accountsettings.update') }}"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <!-- Functional Area -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Functional Area</label>
                                <input type="text" name="functional_area" class="form-control"
                                    placeholder="e.g. Web Development, Marketing">
                            </div>

                            <!-- Special Skills -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Special Skills</label>
                                <textarea name="special_skills" class="form-control" rows="2"
                                    placeholder="e.g. Leadership, Communication, Creative thinking"></textarea>
                            </div>

                            <!-- Preferred Locations Inside Country -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Preferred Locations (Inside Bangladesh)</label>

                                <select name="preferred_locations_inside[]" class="form-control" multiple>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                </select>

                                <small class="text-muted">Select multiple preferred work locations.</small>
                            </div>

                            <!-- Preferred Locations Outside Country -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Preferred Locations (Outside Bangladesh)</label>

                                <select name="preferred_locations_outside[]" class="form-control" multiple>
                                    <option value="USA">USA</option>
                                    <option value="UK">UK</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="UAE">UAE</option>
                                    <option value="Japan">Japan</option>
                                </select>

                                <small class="text-muted">Select multiple international locations.</small>
                            </div>

                            <!-- Preferred Organization Types -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Preferred Organization Types</label>

                                <select name="preferred_organization_types[]" class="form-control" multiple>
                                    <option value="Government">Government</option>
                                    <option value="Private Company">Private Company</option>
                                    <option value="International NGO">International NGO</option>
                                    <option value="Local NGO">Local NGO</option>
                                    <option value="Startup">Startup</option>
                                    <option value="Multinational Company">Multinational Company</option>
                                    <option value="Educational Institution">Educational Institution</option>
                                </select>

                                <small class="text-muted">Select multiple organization types.</small>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="need_update"
                                        value="preferredJobCategory">
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
                            <button type="button" class="btn btn-primary" id="add-category">
                                <i class="fa fa-plus mr-2"></i> @lang('Add Category (If Required)')
                            </button>
                            <button type="button" class="btn btn-danger" id="cancel-category">
                                <i class="fa fa-times mr-2"></i> @lang('Cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
