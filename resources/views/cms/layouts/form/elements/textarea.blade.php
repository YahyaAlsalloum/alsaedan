<div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="last-name">{{ $label }}
        {!!  isset($isRequired) && $isRequired==true ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <textarea class="form-control {{ isset($classes) ? $classes : ''}}" id="{{ $id }}" name="{{ $name }}" rows="3"
                  @if($isShow != 0) readonly="true" disabled @endif
                  required="{{ isset($isRequired) ? $isRequired : 'false' }}">{{ isset($value) ? $value : old($name) }}</textarea>
        @error($name)
        <span style="color:red">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
</div>
