<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
@if((!isset($isEdit) || $type!=='password') || auth()->user()->role->id == 2)


    <div class="form-group">
        <label class="control-label col-12" for="{{ $name }}">{{ $label }}
            @if((isset($isEdit) && $type==='password') ||  $type!=='password' || !isset($isEdit))
                {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
            @endif
        </label>
        <div class="col-12">
            <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
                   {{ $isRequired == "true" ? " required" : " " }}
                   {{ isset($readOnly) && $readOnly == "true" ? " readonly" : "true" }}
                   value="{{ isset($value) ? $value : old($name) }}"
                   @if($isShow != 0) readonly="true" disabled @endif
                   class="form-control col-12 @isset($classes) {{ $classes }} @endisset ">
                @error($name)
                <span style="color:red">
                    {{ $message }}
                </span>
                @enderror
        </div>
    </div>
@endif

</div>
