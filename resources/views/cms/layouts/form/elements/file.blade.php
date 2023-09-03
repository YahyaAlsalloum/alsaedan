{{--<div class="col-lg-4">--}}
{{--<div class="form-group">--}}
{{--    <div class="w-100 text-center">--}}
{{--        <img--}}
{{--            src="@if(isset($custom) && isset($value)) {{ asset($value) }}--}}
{{--            @elseif(isset($custom) && !isset($value)) {{ asset('img/logo-placeholder.png') }}--}}
{{--            @elseif(!isset($company->logo) || is_null($company->logo) || empty($company->logo)){{ asset('img/logo-placeholder.png') }}--}}
{{--            @else {{ $company->logo }} @endif"--}}
{{--            name="image-holder" id="image-holder{{$id}}" height="150"--}}
{{--            width="150"--}}
{{--            style="display: block;margin: 0 26%;"><br>--}}
{{--    </div>--}}
{{--    <div class="col-12" style="padding-left: 17%;">--}}

{{--        <label class="control-label col-12" for="last-name">{{ $label }}--}}
{{--            {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}--}}
{{--        </label>--}}
{{--        <input type="file" id="{{ $id }}" onchange="preview_image(event,'{{$id}}')" name="{{ $name  }}" @if($isShow != 0) readonly="true" disabled @endif />--}}
{{--        <label for="{{ $id }}" class="btn-2">upload</label>--}}
{{--        @error($name)--}}
{{--        <span style="color:red">--}}
{{--        {{ $message }}--}}
{{--        </span>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}




<div class="col-md-9 col-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
    <div class="form-group">
        <div class="col-12 text-center">
            <img
                src="@if(isset($custom) && isset($value)) {{ asset($value) }}
                @elseif(isset($custom) && !isset($value)) {{ asset('img/logo-placeholder.png') }}
                @elseif(!isset($company->logo) || is_null($company->logo) || empty($company->logo)){{ asset('img/logo-placeholder.png') }}
                @else {{ $company->logo }} @endif"
                class="image-display"
                style="display: block;margin: 0 26%;">
        </div>
        <label class="control-label col-12" for="cover_image"> {{ $label }}{!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!} </label>
        <div class="control-image-field col-12 d-flex flex-row">
            <input type="file" id="{{ $id }}" name="{{$name}}"  value="{{old('cover_image')}}"   onchange="readURL(this,$(this).parent().parent().find('.image-display'));" class="input-file d-none"/>
            <span class="file-input-name-preview col-8"> </span>
            <label class="upload-file-label col-3 offset-1" for="{{ $id }}">Upload</label>
            @error($name)
            <span style="color:red">
        {{ $message }}
        </span>
            @enderror
        </div>
    </div><!-- /.form-group -->
</div><!-- /.col-9 -->
