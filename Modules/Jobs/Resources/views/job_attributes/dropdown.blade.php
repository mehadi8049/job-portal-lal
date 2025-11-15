<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" class="form-control">
      <option value="" {{ old($name, $default_value) == '' ? 'selected' : '' }}>@lang('Select') {{ $label }}</option>
      @foreach($items as $item)
        <option value="{{ $item->id }}" {{ old($name, $default_value) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
      @endforeach
    </select>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>