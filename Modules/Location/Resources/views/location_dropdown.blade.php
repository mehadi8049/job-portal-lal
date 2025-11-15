<div class="form-group">
    <label class="form-label">{{ $labels[0] }}</label>
    <select name="{{ $names[0] }}" class="form-control">
      <option value="" {{ old($names[0], $default_values[0]) == '' ? 'selected' : '' }}>@lang('Select') {{ $labels[0] }}</option>
      @foreach($countries as $country)
        <option value="{{ $country->id }}" {{ old($names[0], $default_values[0]) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
      @endforeach
    </select>
    @error($names[0])
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">{{ $labels[1] }}</label>
    <select name="{{ $names[1] }}" class="form-control">
    </select>
    @error($names[1])
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label class="form-label">{{ $labels[2] }}</label>
    <select name="{{ $names[2] }}" class="form-control">
    </select>
    @error($names[2])
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

@push('scripts')
<script>
  const NAME_COUNTRY = '{{ $names[0] }}';
  const NAME_STATE = '{{ $names[1] }}';
  let VALUE_STATE = '{{ old($names[1], $default_values[1]) }}';
  const NAME_CITY = '{{ $names[2] }}';
  let VALUE_CITY = '{{ old($names[2], $default_values[2]) }}';
  const LABEL_STATE = '{{ $labels[1] }}';
  const LABEL_CITY = '{{ $labels[2] }}';
  const URL_GET_STATES_AJAX = "{{ route('settings.location.states.ajaxgetstates') }}";
  const URL_GET_CITIES_AJAX = "{{ route('settings.location.cities.ajaxgetcities') }}";
</script>
<script src="{{ Module::asset('location:js/location_dropdown.js') }}"></script>
@endpush