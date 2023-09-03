<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="{{ $name }}">{{ $label }}
        {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
               required="{{ $isRequired ? $isRequired : 'false' }}"
               @if(isset($value)&&$value==1)  checked @endif
               @if($isShow != 0) readonly="true" disabled @endif
               class="form-control col-12 @isset($classes) {{ $classes }} @endisset ">
        @error($name)
        <span style="color:red">
                    {{ $message }}
                </span>
        @enderror
    </div>
</div>
</div>

