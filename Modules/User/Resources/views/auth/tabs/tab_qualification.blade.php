<div class="tab-pane" id="tab_qualification">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">@lang('Name')</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="@lang('Full name')">
            </div>
        </div>
    </div>
</div>