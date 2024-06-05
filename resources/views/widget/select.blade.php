@php
  $class ??= null;
  $name ??= '';
  $valeur ??= collect($valeur)->map(fn($value) => (int) $value);
  $label ??= ucfirst($label ?? $name);
@endphp

<div @class(['form-group', $class, 'mt-2'])>
  <label class="label-form" for="{{ $name }}">{{ $label }}</label>
  <select name="{{ $name }}[]" id="{{ $name }}" multiple class="form-control @error($name) is-invalid @enderror">
    @foreach ($options as $k => $v)
        <option value="{{ (int) $k }}" {{ $valeur->contains((int) $k) ? 'selected' : '' }}>{{ $v }}</option>
    @endforeach
  </select>
  @error($name)
    <div class="invalid-feedback">
      <span class="text-danger">{{ $message }}</span>
    </div>
  @enderror
</div>
