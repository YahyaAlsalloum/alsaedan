<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
<div class="form-group">
    <div class="w-100 text-center">
        <img
            src="@if(isset($custom) && isset($value)) {{ asset($value) }}
            @elseif(isset($custom) && !isset($value)) {{ asset('img/logo-placeholder.png') }}
            @elseif(!isset($company->logo) || is_null($company->logo) || empty($company->logo)){{ asset('img/logo-placeholder.png') }}
            @else {{ $company->logo }} @endif"
            name="image-holder" id="image-holder" height="150"
            width="150"
            style="display: block;margin: 0 25%;"><br>
    </div>
    <div class="col-12" style="padding-left: 17%;">

        <label class="control-label col-12" for="last-name">{{ $label }}
            {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
        </label>
        <input type="file" id="{{ $id }}" name="{{ $name  }}" @if($isShow != 0) readonly="true" disabled @endif />
        <label for="{{ $id }}" class="btn-2">upload</label>
        @error($name)
        <span style="color:red">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
</div>
