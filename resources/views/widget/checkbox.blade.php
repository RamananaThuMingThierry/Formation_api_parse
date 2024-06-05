@php
  $class ??= null;
  $label ??= '';
@endphp

<div @class(['form-check form-switch', $class, 'mt-2'])>
  <input type="hidden" value="0" name="{{ $name }}" />
  <input @checked(old($name, $value ?? false)) type="checkbox" value="1" name="{{ $name }}" class="form-check-input @error($name) is-invalid @enderror">
  <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
  @error($name)
    <div class="invalid-feedback">
      <span class="text-danger">{{ $message }}</span>
    </div>
  @enderror
</div>