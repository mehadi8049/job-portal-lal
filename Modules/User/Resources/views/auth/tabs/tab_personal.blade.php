<div class="tab-pane active" id="tab_profile">
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">@lang('Password')</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password" placeholder="@lang('Password')">
            </div>
            <div class="form-group">
                <label class="form-label">@lang('Confirm password')</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password_confirmation" placeholder="@lang('Confirm password')">
            </div>
            <div class="alert alert-info">
                @lang('Type new password if you would like to change current password.')
            </div>
        </div>
    </div>
</div>
