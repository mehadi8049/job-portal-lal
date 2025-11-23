
<div class="tab-pane {{request()->tab=='experience'?'active':''}}" id="tab_experience">
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
                        <form role="form" method="post" action="{{ route('experience.update', $experience->id) }}"
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
                                            class="form-control {{ $errors->has('responsibilities') ? 'is-invalid' : '' }}" placeholder="@lang('Responsibilities')">{{ old('responsibilities', $experience->responsibilities) }}</textarea>
                                    </div>
                                </div>

                                <!-- Area of Expertise (tag input) -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Area of Expertise')</label>

                                        <!-- NOTE: visible input MUST NOT have a name attribute -->
                                        <div id="expertise-container-{{ $experience->id }}" class="form-control p-2"
                                            style="min-height:40px;">
                                            <input type="text" id="expertise-input-{{ $experience->id }}"
                                                placeholder="@lang('Type and press Enter')" autocomplete="off"
                                                style="border:0;outline:0;width:auto;">
                                        </div>

                                        <!-- Hidden inputs will be inserted here (these carry the actual values to the server) -->
                                        <div id="expertise-hidden-{{ $experience->id }}"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Company Location')</label>
                                        <input type="text" name="company_location"
                                            value="{{ old('company_location', $experience->company_location) }}"
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
                        @include('user::auth.tabs.expertise-script', ['experience' => $experience])
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
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {

                                let input = document.getElementById("expertise-input");
                                let container = document.getElementById("expertise-container");
                                let hiddenContainer = document.getElementById("expertise-hidden");

                                // Load existing tags from DB (make sure your model casts 'area_of_expertise' as array)
                                let existingTags = @json($experience->area_of_expertise ?? []);

                                // Function to create a tag
                                function addTag(value) {
                                    if (!value || !value.trim()) return;
                                    value = value.trim();

                                    // Prevent duplicates
                                    if (Array.from(hiddenContainer.children).some(h => h.value === value)) {
                                        input.value = "";
                                        return;
                                    }

                                    // Create visible tag
                                    const tag = document.createElement("span");
                                    tag.className = "badge mr-2 mb-2 p-2";
                                    tag.style.backgroundColor = "#17a2b8"; // Bootstrap info color
                                    tag.style.color = "#fff"; // white text
                                    tag.style.fontSize = "14px";
                                    tag.style.display = "inline-flex";
                                    tag.style.alignItems = "center";
                                    tag.style.borderRadius = "5px";

                                    tag.innerHTML = `
            ${escapeHtml(value)}
            <button type="button" title="Remove" style="border:0; background:transparent; color:#fff; margin-left:6px; cursor:pointer; font-weight:bold;">&times;</button>
        `;

                                    // Hidden input for submission
                                    const hidden = document.createElement("input");
                                    hidden.type = "hidden";
                                    hidden.name = "area_of_expertise[]";
                                    hidden.value = value;

                                    // Insert tag and hidden input
                                    container.insertBefore(tag, input);
                                    hiddenContainer.appendChild(hidden);

                                    // Remove handler
                                    tag.querySelector("button").addEventListener("click", () => {
                                        tag.remove();
                                        hidden.remove();
                                    });

                                    input.value = "";
                                    input.focus();
                                }

                                // Escape HTML
                                function escapeHtml(str) {
                                    return String(str)
                                        .replace(/&/g, '&amp;')
                                        .replace(/</g, '&lt;')
                                        .replace(/>/g, '&gt;')
                                        .replace(/"/g, '&quot;')
                                        .replace(/'/g, '&#039;');
                                }

                                // Load existing tags
                                if (Array.isArray(existingTags)) {
                                    existingTags.forEach(t => addTag(t));
                                }

                                // Add tag on Enter
                                input.addEventListener("keydown", function(e) {
                                    if (e.key === "Enter") {
                                        e.preventDefault(); // prevent form submit
                                        addTag(input.value);
                                    }
                                    // Optional: backspace to remove last tag if input empty
                                    if (e.key === "Backspace" && input.value.trim() === "") {
                                        let hiddenInputs = hiddenContainer.querySelectorAll('input[type="hidden"]');
                                        if (hiddenInputs.length > 0) {
                                            let lastHidden = hiddenInputs[hiddenInputs.length - 1];
                                            let visibleTags = container.querySelectorAll('span.badge');
                                            if (visibleTags.length) visibleTags[visibleTags.length - 1].remove();
                                            lastHidden.remove();
                                        }
                                    }
                                });

                                // Focus input when clicking container
                                container.addEventListener("click", () => input.focus());

                            });
                        </script>


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
