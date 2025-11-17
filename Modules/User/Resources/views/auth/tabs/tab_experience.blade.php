<div class="tab-pane" id="tab_experience">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">@lang('Name')</label>
                <input type="text" name="name" value="{{ $user->name }}"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="@lang('Full name')">
            </div>
            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" value="{{ $user->email }}" class="form-control disabled" placeholder="E-mail"
                    disabled>
                <small class="help-block">@lang("E-mail can't be changed")</small>
            </div>
        </div>
    </div>
</div>
